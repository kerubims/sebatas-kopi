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
    public function history()
    {
        $orders = auth()->user()
            ? auth()->user()->orders()
                ->with(['orderItems.product', 'orderItems.extras'])
                ->where('status', 'paid')                 
                ->orderBy('created_at', 'desc')
                ->get()
            : collect();
        
        return view('user.history', compact('orders'));
    }
}