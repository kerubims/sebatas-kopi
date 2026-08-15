<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display the menu page with all products grouped by category
     */
    public function index(Request $request)
    {
        $categories = Category::with('products')->get();
        $products = Product::where('is_available', true)->get();
        $extras = \App\Models\Extra::where('is_available', true)->get();
        
        // Get the selected category from query parameter
        $selectedCategory = $request->query('category');
        $search = $request->query('search');
        
        return view('user.menu', compact('categories', 'products', 'extras', 'selectedCategory', 'search'));
    }
}