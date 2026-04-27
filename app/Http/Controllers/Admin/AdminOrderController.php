<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product','user');
        return view('admin.orders.show', compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'=>'required|in:pending,processing,shipped,cancelled',
        ]);

        $order->update([
            'status'=>$request->status,
        ]);

        return back()->with('success','Order status updated');
    }
}
