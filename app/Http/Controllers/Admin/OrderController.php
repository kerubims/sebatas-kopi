<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $orders = Order::with('user')
            ->where('status', 'paid')
            ->when($search, function($query) use ($search) {
                $query->where('order_number', 'like', "%{$search}%")
                      ->orWhereHas('user', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders', 'search'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'orderItems.extras']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|in:unpaid,paid,failed',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }
}
