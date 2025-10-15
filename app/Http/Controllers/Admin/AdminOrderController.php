<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'status')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'status', 'items.product');
        $orderStatuses = OrderStatus::all();
        return view('admin.orders.show', compact('order', 'orderStatuses'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        $order->update([
            'order_status_id' => $request->order_status_id,
        ]);

        alert()->success('Success', 'Order status updated successfully.');
        return redirect()->route('admin.orders.show', $order);
    }
}
