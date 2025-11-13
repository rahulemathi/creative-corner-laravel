<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\RefundService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCancelled;

class OrderController extends Controller
{
    protected $refundService;

    public function __construct(RefundService $refundService)
    {
        $this->refundService = $refundService;
    }
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

    public function cancel(Order $order)
    {
        // Ensure the authenticated user owns the order
        if (Auth::id() !== $order->user_id) {
            alert()->error('Error', 'You are not authorized to cancel this order.');
            return redirect()->route('orders.index');
        }

        // Check if order can be cancelled (within 2 hours and in cancellable status)
        $hoursSinceOrder = $order->created_at->diffInHours(now());
        $cancellableStatuses = ['Order Placed', 'Processing', 'Paid'];

        if ($hoursSinceOrder >= 2) {
            alert()->error('Error', 'Orders can only be cancelled within 2 hours of placing them.');
            return redirect()->back();
        }

        if (!in_array($order->status->name, $cancellableStatuses)) {
            alert()->error('Error', 'This order cannot be cancelled as it is already ' . strtolower($order->status->name) . '.');
            return redirect()->back();
        }

        try {
            // Find or create the 'Cancelled' status
            $cancelledStatus = \App\Models\OrderStatus::firstOrCreate(['name' => 'Cancelled']);
            
            // Update order status to cancelled
            $order->update(['order_status_id' => $cancelledStatus->id]);

            // Restore product stock (if you're tracking stock)
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // Process refund for online payments
            $refundMessage = '';
            if ($order->isPaidOnline()) {
                $refundProcessed = $this->refundService->processRefund($order);
                
                if ($refundProcessed) {
                    $refundMessage = ' Your refund has been initiated and will be processed within 3-5 business days.';
                    Log::info("Refund initiated for cancelled order {$order->id}");
                } else {
                    $refundMessage = ' Your refund request has been recorded and will be processed manually within 3-5 business days.';
                    Log::warning("Automatic refund failed for order {$order->id}, will require manual processing");
                }
            } else {
                // Cash on delivery - no refund needed
                $refundMessage = ' No refund is required for cash on delivery orders.';
            }

            // Send notification email
            try {
                Mail::to($order->user->email)->send(new OrderCancelled($order));
            } catch (\Exception $mailException) {
                Log::warning('Failed to send order cancellation email: ' . $mailException->getMessage());
            }

            alert()->success('Success', 'Your order has been successfully cancelled. Stock has been restored.' . $refundMessage);
            
        } catch (\Exception $e) {
            Log::error('Order cancellation failed: ' . $e->getMessage());
            alert()->error('Error', 'Failed to cancel the order. Please contact customer support.');
        }

        return redirect()->route('orders.show', $order);
    }

    /**
     * Check refund status for an order
     */
    public function checkRefundStatus(Order $order)
    {
        // Ensure the authenticated user owns the order
        if (Auth::id() !== $order->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (!$order->refund_id) {
            return response()->json(['status' => 'no_refund', 'message' => 'No refund initiated for this order']);
        }

        $status = $this->refundService->checkRefundStatus($order);
        
        // Update the order with the latest status
        if (isset($status['status']) && $status['status'] !== $order->refund_status) {
            $this->refundService->updateRefundStatus($order);
        }

        return response()->json([
            'refund_status' => $order->fresh()->refund_status,
            'refund_amount' => $order->refund_amount,
            'gateway_status' => $status,
        ]);
    }

    // You might add a store method here for handling new orders from the cart
    // public function store(Request $request)
    // {
    //     // Logic to create an order from the cart
    // }
}
