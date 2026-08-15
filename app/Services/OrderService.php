<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemExtra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderService
{
    /**
     * Create order from cart items
     */
    public function createOrderFromCart(int $userId, array $cartItems): Order
    {
        return DB::transaction(function () use ($userId, $cartItems) {
            // Calculate total
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item['subtotal'];
            }

            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'order_number' => Order::generateOrderNumber(),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Create order item extras
                if (!empty($item['extras'])) {
                    foreach ($item['extras'] as $extra) {
                        OrderItemExtra::create([
                            'order_item_id' => $orderItem->id,
                            'extra_id' => $extra['id'],
                            'extra_name' => $extra['name'],
                            'price' => $extra['price'],
                        ]);
                    }
                }
            }

            return $order;
        });
    }

    /**
     * Create order from single item (Buy Now)
     */
    public function createOrderFromItem(int $userId, array $itemData): Order
    {
        return DB::transaction(function () use ($userId, $itemData) {
            // Calculate total
            $extrasTotal = 0;
            if (!empty($itemData['extras'])) {
                foreach ($itemData['extras'] as $extra) {
                    $extrasTotal += $extra['price'];
                }
            }
            
            $subtotal = ($itemData['price'] + $extrasTotal) * $itemData['quantity'];

            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'order_number' => Order::generateOrderNumber(),
                'total_price' => $subtotal,
                'status' => 'pending',
            ]);

            // Create order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $itemData['product_id'],
                'product_name' => $itemData['product_name'],
                'price' => $itemData['price'],
                'quantity' => $itemData['quantity'],
                'subtotal' => $subtotal,
            ]);

            // Create order item extras
            if (!empty($itemData['extras'])) {
                foreach ($itemData['extras'] as $extra) {
                    OrderItemExtra::create([
                        'order_item_id' => $orderItem->id,
                        'extra_id' => $extra['id'],
                        'extra_name' => $extra['name'],
                        'price' => $extra['price'],
                    ]);
                }
            }

            return $order;
        });
    }

    /**
     * Get Snap token from Midtrans
     */
    public function getSnapToken(Order $order): ?string
    {
        try {
            // Pastikan menggunakan file config, bukan env() langsung
            $serverKey = config('midtrans.server_key');
            $isProduction = config('midtrans.is_production');
            
            $url = $isProduction 
                ? 'https://app.midtrans.com/snap/v1/transactions'
                : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            // 1. Generate Item Details Terlebih Dahulu
            $itemDetails = $this->getItemDetails($order);

            // 2. Hitung Ulang Gross Amount dari Item Details (Agar 100% Cocok)
            $calculatedGrossAmount = 0;
            foreach ($itemDetails as $item) {
                $calculatedGrossAmount += ($item['price'] * $item['quantity']);
            }

            // Prepare transaction details
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => $calculatedGrossAmount, // Gunakan hasil hitungan ulang
                ],
                'customer_details' => [
                    'first_name' => $order->user->name,
                    'email' => $order->user->email,
                    'phone' => $order->user->phone ?? '', // Tambahkan phone jika ada
                ],
                'item_details' => $itemDetails,
            ];

            // Make request to Midtrans
            $response = Http::withBasicAuth($serverKey, '')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post($url, $params);

            if ($response->successful()) {
                $snapToken = $response->json('token');
                $order->update(['snap_token' => $snapToken]);
                return $snapToken;
            }

            Log::error('Midtrans Snap Token Error', [
                'response' => $response->json(),
                'status' => $response->status()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    /**
     * Get item details for Midtrans (SAFE VERSION)
     */
    private function getItemDetails(Order $order): array
    {
        $items = [];
        
        foreach ($order->orderItems as $orderItem) {
            // Validasi nama produk
            $productName = $orderItem->product_name;
            if (empty($productName)) {
                $productName = "Product ID " . $orderItem->product_id;
            }

            $items[] = [
                'id' => (string) $orderItem->product_id,
                'price' => (int) $orderItem->price,
                'quantity' => (int) $orderItem->quantity,
                // Potong nama agar maks 50 karakter (Ketentuan Midtrans)
                'name' => substr($productName, 0, 50),
            ];

            // Add extras as separate items
            foreach ($orderItem->extras as $extra) {
                // Validasi nama extra
                $extraName = $extra->extra_name;
                if (empty($extraName)) {
                    $extraName = "Extra";
                }

                $items[] = [
                    'id' => 'EXT-' . $extra->extra_id . '-' . uniqid(), // ID Unik
                    'price' => (int) $extra->price,
                    'quantity' => (int) $orderItem->quantity, // Ikut quantity induk
                    'name' => substr($extraName . ' (Extra)', 0, 50),
                ];
            }
        }

        return $items;
    }

    /**
     * Update order status based on Midtrans notification
     */
    public function updateOrderStatus(string $orderNumber, string $status): bool
    {
        $order = Order::where('order_number', $orderNumber)->first();
        
        if (!$order) {
            return false;
        }

        $order->update(['status' => $status]);
        return true;
    }
}