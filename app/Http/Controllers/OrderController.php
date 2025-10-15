<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('status', 'items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the authenticated user owns the order
        if (Auth::id() !== $order->user_id) {
            alert()->error('Error', 'You are not authorized to view this order.');
            return redirect()->route('orders.index');
        }
        $order->load('status', 'items.product');
        return view('orders.show', compact('order'));
    }

    // You might add a store method here for handling new orders from the cart
    // public function store(Request $request)
    // {
    //     // Logic to create an order from the cart
    // }
}
