<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderService;
    protected $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    /**
     * Checkout from cart or direct buy - creates order and redirects to checkout page
     */
    public function initCheckout(Request $request)
    {
        try {
            // A. Jika Direct Buy (Beli Langsung)
            if ($request->has('direct_buy') && $request->direct_buy) {
                $request->validate([
                    'product_id' => 'required|integer',
                    'product_name' => 'required|string',
                    'price' => 'required|integer',
                    'quantity' => 'required|integer|min:1',
                    'extras' => 'nullable|array',
                ]);

                // Simpan detail pembelian ke session
                session(['checkout_session' => [
                    'type' => 'direct',
                    'data' => [
                        'product_id' => $request->product_id,
                        'product_name' => $request->product_name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'extras' => $request->extras ?? [],
                    ]
                ]]);
            } 
            // B. Jika dari Cart
            else {
                $cartItems = $this->cartService->getItems();
                if (empty($cartItems)) {
                    return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
                }

                // Cukup tandai bahwa ini checkout dari cart
                session(['checkout_session' => [
                    'type' => 'cart',
                    'data' => $cartItems // Simpan snapshot cart saat ini
                ]]);
            }

            return response()->json([
                'success' => true,
                'redirect_url' => route('checkout.review')
            ]);

        } catch (\Exception $e) {
            Log::error('Checkout Init Error', ['msg' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error starting checkout'], 500);
        }
    }

    /**
     * TAHAP 2: Halaman Review (Baca dari Session, Tanpa DB)
     */
    public function reviewPage()
    {
        $sessionData = session('checkout_session');

        if (!$sessionData) {
            return redirect()->route('menu')->with('error', 'No checkout session found');
        }

        // Kita harus membuat struktur objek "Palsu" (Mock) yang mirip dengan model Order
        // Agar view checkout.blade.php tidak error saat me-looping $order->orderItems
        
        $mockOrderItems = collect([]);
        $totalPrice = 0;

        if ($sessionData['type'] === 'direct') {
            $data = $sessionData['data'];
            
            // Hitung harga extras
            $extrasTotal = 0;
            $mockExtras = collect([]);
            foreach ($data['extras'] as $ex) {
                $extrasTotal += $ex['price'];
                $mockExtras->push((object)[
                    'name' => $ex['name'],
                    'price' => $ex['price']
                ]);
            }

            $subtotal = ($data['price'] + $extrasTotal) * $data['quantity'];
            $totalPrice = $subtotal;

            // Ambil data produk asli untuk gambar
            $productDB = Product::find($data['product_id']);

            // Buat Item Palsu
            $mockOrderItems->push((object)[
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'subtotal' => $subtotal,
                'product' => $productDB, // Attach relasi produk asli
                'extras' => $mockExtras
            ]);

        } else {
            // Tipe Cart
            foreach ($sessionData['data'] as $item) {
                $mockExtras = collect([]);
                foreach ($item['extras'] as $ex) {
                    $mockExtras->push((object)[
                        'name' => $ex['name'],
                        'price' => $ex['price']
                    ]);
                }

                $productDB = Product::find($item['product_id']);

                $mockOrderItems->push((object)[
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                    'product' => $productDB,
                    'extras' => $mockExtras
                ]);

                $totalPrice += $item['subtotal'];
            }
        }

        // Bungkus dalam objek Order palsu
        $order = (object) [
            'order_number' => 'DRAFT-PREVIEW', // Placeholder
            'total_price' => $totalPrice,
            'orderItems' => $mockOrderItems
        ];

        return view('user.checkout', compact('order'));
    }

    /**
     * TAHAP 3: Proses Final (Simpan DB & Minta Token)
     */
    public function processPayment()
    {
        try {
            $sessionData = session('checkout_session');
            $user = Auth::user();

            if (!$sessionData) {
                return response()->json(['success' => false, 'message' => 'Session expired'], 400);
            }

            // 1. Simpan ke Database (Panggil Service)
            if ($sessionData['type'] === 'direct') {
                $order = $this->orderService->createOrderFromItem($user->id, $sessionData['data']);
            } else {
                // Ambil data cart terbaru dari service (untuk memastikan stok/harga valid)
                // Atau gunakan snapshot sessionData['data'] jika ingin harga terkunci
                $order = $this->orderService->createOrderFromCart($user->id, $sessionData['data']);
                
                // Hapus Cart HANYA jika order berhasil dibuat
                $this->cartService->clearCart();
            }

            // 2. Minta Snap Token Midtrans
            $snapToken = $this->orderService->getSnapToken($order);

            if (!$snapToken) {
                return response()->json(['success' => false, 'message' => 'Failed to get token'], 500);
            }

            // 3. Hapus session checkout agar tidak bisa di-refresh
            session()->forget('checkout_session');

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_number' => $order->order_number
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Process Error', ['msg' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server Error'], 500);
        }
    }

    /**
     * Handle Midtrans payment callback/notification
     */
    public function callback(Request $request)
    {
        try {
            $serverKey = config('midtrans.server_key');
            $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            // Verify signature
            // if ($hashed !== $request->signature_key) {
            //     return response()->json(['message' => 'Invalid signature'], 403);
            // }

            $transactionStatus = $request->transaction_status;
            $orderNumber = $request->order_id;
            $paymentType = $request->payment_type ?? 'unknown';

            // Map Midtrans status to our order status
            $status = 'pending';
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $status = 'paid';
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $status = 'failed';
            }

            // Update order status and payment type
            $order = Order::where('order_number', $orderNumber)->first();
            if ($order) {
                $order->update([
                    'status' => $status,
                    'payment_type' => $paymentType
                ]);
            }

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function simulateCallback($orderNumber, $status)
    {
        // 1. Validasi Environment (Opsional: Matikan jika sudah Live Production)
        // if (!app()->isLocal()) {
        //     abort(403, 'Simulation is only available in local environment');
        // }

        // 2. Cari Order
        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) {
            return "Order {$orderNumber} tidak ditemukan.";
        }

        // 3. Setup Variabel Mocking Midtrans
        $serverKey = config('midtrans.server_key');
        
        // Midtrans mengirim gross_amount dengan format desimal string (misal: "18000.00")
        // Kita format agar cocok dengan hashing
        $grossAmount = number_format($order->total_price, 2, '.', ''); 
        
        // Mapping Status Sederhana ke Status Teknis Midtrans
        $transactionStatus = 'pending';
        $statusCode = '201';

        switch ($status) {
            case 'paid':
            case 'settlement':
            case 'capture':
                $transactionStatus = 'settlement';
                $statusCode = '200';
                break;
            case 'pending':
                $transactionStatus = 'pending';
                $statusCode = '201';
                break;
            case 'failed':
            case 'deny':
            case 'expire':
            case 'cancel':
                $transactionStatus = 'expire';
                $statusCode = '407';
                break;
            default:
                return "Status '{$status}' tidak dikenali. Gunakan: paid, pending, atau failed.";
        }

        // 4. GENERATE SIGNATURE KEY (PENTING!)
        // Ini kuncinya: Kita membuat tanda tangan palsu yang VALID agar lolos pengecekan di method callback()
        // Rumus: SHA512(order_id + status_code + gross_amount + ServerKey)
        $signatureKey = hash("sha512", $order->order_number . $statusCode . $grossAmount . $serverKey);

        // 5. Buat Request Palsu (Mock Request)
        $mockRequest = new Request();
        $mockRequest->replace([
            'transaction_time'   => now()->format('Y-m-d H:i:s'),
            'transaction_status' => $transactionStatus,
            'transaction_id'     => 'SIMULATED-' . uniqid(),
            'status_message'     => "Simulated status changed to {$status}",
            'status_code'        => $statusCode,
            'signature_key'      => $signatureKey, // Signature Valid
            'payment_type'       => 'bank_transfer',
            'order_id'           => $order->order_number,
            'merchant_id'        => 'G-SIMULATOR',
            'gross_amount'       => $grossAmount,
            'currency'           => 'IDR',
        ]);

        // 6. Panggil Method Callback Asli dengan Request Palsu
        // Kita memanggil $this->callback() seolah-olah itu dipanggil oleh Midtrans
        $response = $this->callback($mockRequest);

        // 7. Feedback ke Browser
        // Kita cek status code dari response JSON milik callback()
        if ($response->getStatusCode() == 200) {
            return redirect()->route('checkout.success', $orderNumber);
        } else {
            // Jika gagal (misal 403 Invalid Signature), tampilkan errornya
            $content = json_decode($response->getContent());
            return "Simulasi GAGAL. Response: " . ($content->message ?? 'Unknown Error');
        }
    }
    public function paymentSuccess($orderNumber)
    {
        // Pastikan order milik user yang sedang login agar tidak bisa diintip orang lain
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.payment-success', compact('order'));
    }
}
