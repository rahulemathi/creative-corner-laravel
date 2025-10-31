<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Mail\OrderPlacedMail;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        // Sweet Alert on cart page if no address exists
        if (Auth::check() && !Address::where('user_id', Auth::id())->exists()) {
            alert()->html(
                'No address found',
                'Currently there is no address. <a href="'.route('profile.addresses').'" class="underline text-pink-600">Click here</a> to add a new one.',
                'warning'
            );
        }
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            alert()->error('Error', 'Not enough stock available.');
            return back();
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->sale_price ?? $product->price,
                "image" => $product->images[0] ?? '' // Assuming first image is thumbnail
            ];
        }

        session()->put('cart', $cart);
        alert()->success('Success', 'Product added to cart successfully!');
        return redirect()->route('cart.index');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $quantity = $request->quantity;

        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            if ($quantity == 0) {
                unset($cart[$product->id]);
                alert()->success('Success', 'Product removed from cart successfully!');
            } else if ($product->stock < $quantity) {
                alert()->error('Error', 'Not enough stock available.');
                return back();
            } else {
                $cart[$product->id]['quantity'] = $quantity;
                alert()->success('Success', 'Cart updated successfully!');
            }
            session()->put('cart', $cart);
            return redirect()->route('cart.index');
        }

        alert()->error('Error', 'Product not found in cart.');
        return back();
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            alert()->success('Success', 'Product removed from cart successfully!');
        }
        return redirect()->route('cart.index');
    }

    // SHOW Razorpay Checkout page
    public function payment()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            alert()->error('Error', 'Your cart is empty.');
            return redirect()->route('cart.index');
        }

        // Require at least one address before proceeding to checkout
        if (!Address::where('user_id', Auth::id())->exists()) {
            alert()->html(
                'No address found',
                'To proceed further, please <a href="'.route('profile.addresses').'" class="underline text-pink-600">click here</a> to add an address.',
                'warning'
            );
            return redirect()->route('cart.index');
        }

        $amount = 0;
        foreach ($cart as $item) {
            $amount += ($item['price'] * $item['quantity']);
        }

        $amountInPaise = (int) round($amount * 100);

        $apiKey = env('RAZORPAY_KEY_ID');
        $apiSecret = env('RAZORPAY_KEY_SECRET');
        if (!$apiKey || !$apiSecret) {
            alert()->error('Error', 'Razorpay keys are not configured.');
            return redirect()->route('cart.index');
        }

        $api = new Api($apiKey, $apiSecret);
        $receipt = (string) Str::uuid();
        $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => $amountInPaise,
            'currency' => 'INR',
        ]);

        // Store order id in session for later verification
        session()->put('razorpay_order_id', $order['id']);
        session()->put('razorpay_order_amount', $amountInPaise);

        return view('cart.checkout', [
            'key' => $apiKey,
            'orderId' => $order['id'],
            'amount' => $amountInPaise,
            'displayAmount' => $amount,
            'name' => config('app.name', 'Manhitha'),
            'prefill' => [
                'name' => Auth::user()->name ?? 'Guest',
                'email' => Auth::user()->email ?? '',
                'address'=>session('selected_address'),
            ],
        ]);
    }

    // HANDLE Razorpay callback
    public function paymentStore(Request $request)
    {
        $apiKey = env('RAZORPAY_KEY_ID');
        $apiSecret = env('RAZORPAY_KEY_SECRET');
        $razorpayOrderId = session()->get('razorpay_order_id');

        $attributes = [
            'razorpay_order_id' => $request->input('razorpay_order_id'),
            'razorpay_payment_id' => $request->input('razorpay_payment_id'),
            'razorpay_signature' => $request->input('razorpay_signature'),
        ];

        try {
            $api = new Api($apiKey, $apiSecret);
            $api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            alert()->error('Payment Failed', 'Signature verification failed.');
            return redirect()->route('cart.index');
        }

        // At this point, payment is successful & verified
        // Create Order and OrderItems, decrement product quantity
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            alert()->warning('Notice', 'Cart was empty after payment.');
            return redirect()->route('orders.index');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($cart) {
            $total = 0;
            foreach ($cart as $productId => $item) {
                $total += ($item['price'] * $item['quantity']);
            }

            // Set initial Order Status as Order Placed (payment is separate)
            $status = \App\Models\OrderStatus::firstOrCreate(['name' => 'Order Placed']);

            $order = \App\Models\Order::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'order_status_id' => $status->id,
                'total_amount' => $total,
                'shipping_address' => session('selected_address'),
                'order_date' => now(),
            ]);
            session()->forget('selected_address');

            foreach ($cart as $productId => $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Decrement available stock
                $product = \App\Models\Product::find($productId);
                if ($product) {
                    $newStock = max(0, (int)$product->stock - (int)$item['quantity']);
                    $product->update(['stock' => $newStock]);
                }
            }

            // Send order placed email to the user with order details
            $order->load('user', 'items.product');
            if ($order->user && $order->user->email) {
                Mail::to($order->user->email)->send(new OrderPlacedMail($order));
            }
        });

        // Clear session
        session()->forget('cart');
        session()->forget('razorpay_order_id');
        session()->forget('razorpay_order_amount');

        alert()->success('Payment Successful', 'Your order has been placed.');
        return redirect()->route('orders.index');
    }
}
