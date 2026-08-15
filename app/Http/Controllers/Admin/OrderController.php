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
        $status = $request->get('status');
        $date = $request->get('date');
        
        $orders = Order::query()
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('order_number', 'like', "%{$search}%")
                      ->orWhere('table_number', 'like', "%{$search}%");
                });
            })
            ->when($status, function($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($date, function($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        return view('admin.orders.index', compact('orders', 'search', 'status', 'date'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.product', 'orderItems.extras']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,completed,failed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }
}
