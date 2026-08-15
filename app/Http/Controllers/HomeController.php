<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil semua kategori untuk bagian zigzag
        $categories = Category::all();

        // 2. Ambil 2 produk untuk bagian "Best Sellers"
        // (Idealnya nanti ada kolom 'is_best_seller' di database, tapi kita ambil random/terbaru dulu)
        $bestSellers = Product::take(2)->get(); 

        return view('user.home', compact('categories', 'bestSellers'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        return view('user.about');
    }

    /**
     * Display the history page
     */
    public function history(Request $request)
    {
        $guestOrders = json_decode($request->cookie('guest_orders', '[]'), true);
        if (!is_array($guestOrders)) {
            $guestOrders = [];
        }

        $orders = \App\Models\Order::with(['orderItems.product', 'orderItems.extras'])
            ->whereIn('order_number', $guestOrders)
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Sync pending orders with Midtrans status
        $serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production');
        $baseUrl = $isProduction ? 'https://api.midtrans.com/v2' : 'https://api.sandbox.midtrans.com/v2';

        foreach ($orders as $order) {
            if ($order->status === 'pending') {
                $http = \Illuminate\Support\Facades\Http::withBasicAuth($serverKey, '');
                if (!$isProduction) {
                    $http = $http->withoutVerifying();
                }
                
                $response = $http->get("{$baseUrl}/{$order->order_number}/status");
                
                if ($response->successful()) {
                    $transactionStatus = $response->json('transaction_status');
                    $paymentType = $response->json('payment_type') ?? 'unknown';
                    
                    if (in_array($transactionStatus, ['capture', 'settlement'])) {
                        $order->update(['status' => 'paid', 'payment_type' => $paymentType]);
                    } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                        $order->update(['status' => 'failed', 'payment_type' => $paymentType]);
                    }
                }
            }
        }
        
        return view('user.history', compact('orders'));
    }
}