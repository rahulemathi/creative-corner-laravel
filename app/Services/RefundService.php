<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RefundService
{
    /**
     * Process refund for an order
     */
    public function processRefund(Order $order): bool
    {
        if (!$order->isEligibleForRefund()) {
            Log::warning("Order {$order->id} is not eligible for refund");
            return false;
        }

        // Mark refund as initiated
        $order->update([
            'refund_status' => 'initiated',
            'refund_amount' => $order->total_amount,
        ]);

        try {
            $result = match($order->payment_gateway) {
                'razorpay' => $this->processRazorpayRefund($order),
                'payu' => $this->processPayURefund($order),
                'stripe' => $this->processStripeRefund($order),
                default => $this->processFallbackRefund($order)
            };

            if ($result['success']) {
                $order->update([
                    'refund_status' => 'processing',
                    'refund_id' => $result['refund_id'] ?? null,
                    'refund_processed_at' => now(),
                ]);

                Log::info("Refund initiated successfully for order {$order->id}", $result);
                return true;
            } else {
                $order->update(['refund_status' => 'failed']);
                Log::error("Refund failed for order {$order->id}: " . $result['message']);
                return false;
            }
        } catch (Exception $e) {
            $order->update(['refund_status' => 'failed']);
            Log::error("Refund exception for order {$order->id}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Process Razorpay refund
     */
    private function processRazorpayRefund(Order $order): array
    {
        if (!$order->payment_id) {
            return ['success' => false, 'message' => 'No payment ID found'];
        }

        try {
            $auth = base64_encode(config('services.razorpay.key_id') . ':' . config('services.razorpay.key_secret'));
            
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $auth,
                'Content-Type' => 'application/json',
            ])->post("https://api.razorpay.com/v1/payments/{$order->payment_id}/refund", [
                'amount' => $order->refund_amount * 100, // Convert to paise
                'speed' => 'normal',
                'notes' => [
                    'order_id' => $order->id,
                    'reason' => 'Order cancelled by customer',
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'refund_id' => $data['id'],
                    'gateway_response' => $data,
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Razorpay API error: ' . $response->body(),
                ];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Process PayU refund
     */
    private function processPayURefund(Order $order): array
    {
        if (!$order->payment_id) {
            return ['success' => false, 'message' => 'No payment ID found'];
        }

        try {
            $params = [
                'key' => config('services.payu.key'),
                'command' => 'cancel_refund_transaction',
                'var1' => $order->payment_id,
                'var2' => $order->refund_amount,
                'var3' => 'Order cancelled by customer',
                'hash' => $this->generatePayUHash($order),
            ];

            $response = Http::asForm()->post('https://secure.payu.in/merchant/postservice?form=2', $params);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['status']) && $data['status'] === 'success') {
                    return [
                        'success' => true,
                        'refund_id' => $data['request_id'] ?? $order->payment_id . '_refund',
                        'gateway_response' => $data,
                    ];
                }
            }

            return [
                'success' => false,
                'message' => 'PayU refund failed: ' . $response->body(),
            ];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Process Stripe refund
     */
    private function processStripeRefund(Order $order): array
    {
        if (!$order->payment_id) {
            return ['success' => false, 'message' => 'No payment ID found'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.stripe.secret'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post('https://api.stripe.com/v1/refunds', [
                'payment_intent' => $order->payment_id,
                'amount' => $order->refund_amount * 100, // Convert to cents
                'metadata' => [
                    'order_id' => $order->id,
                    'reason' => 'requested_by_customer',
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'refund_id' => $data['id'],
                    'gateway_response' => $data,
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Stripe API error: ' . $response->body(),
                ];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Fallback refund process for unknown gateways
     */
    private function processFallbackRefund(Order $order): array
    {
        // For unknown gateways, mark as manual review required
        Log::warning("Unknown payment gateway '{$order->payment_gateway}' for order {$order->id}. Manual refund required.");
        
        return [
            'success' => true, // Mark as success but will need manual processing
            'refund_id' => 'manual_' . $order->id . '_' . time(),
            'message' => 'Manual refund processing required',
        ];
    }

    /**
     * Generate PayU hash for refund
     */
    private function generatePayUHash(Order $order): string
    {
        $key = config('services.payu.key');
        $salt = config('services.payu.salt');
        $command = 'cancel_refund_transaction';
        
        $hashString = $key . '|' . $command . '|' . $order->payment_id . '|' . $salt;
        return hash('sha512', $hashString);
    }

    /**
     * Check refund status for an order
     */
    public function checkRefundStatus(Order $order): array
    {
        if (!$order->refund_id) {
            return ['status' => 'not_found', 'message' => 'No refund ID found'];
        }

        return match($order->payment_gateway) {
            'razorpay' => $this->checkRazorpayRefundStatus($order),
            'payu' => $this->checkPayURefundStatus($order),
            'stripe' => $this->checkStripeRefundStatus($order),
            default => ['status' => 'unknown', 'message' => 'Gateway status check not supported']
        };
    }

    /**
     * Check Razorpay refund status
     */
    private function checkRazorpayRefundStatus(Order $order): array
    {
        try {
            $auth = base64_encode(config('services.razorpay.key_id') . ':' . config('services.razorpay.key_secret'));
            
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $auth,
            ])->get("https://api.razorpay.com/v1/refunds/{$order->refund_id}");

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'status' => $data['status'],
                    'amount' => $data['amount'] / 100,
                    'gateway_data' => $data,
                ];
            }
        } catch (Exception $e) {
            Log::error("Error checking Razorpay refund status: " . $e->getMessage());
        }

        return ['status' => 'error', 'message' => 'Could not check refund status'];
    }

    /**
     * Check PayU refund status
     */
    private function checkPayURefundStatus(Order $order): array
    {
        // PayU doesn't have a direct refund status API
        // This would require implementing their webhook or manual checking
        return ['status' => 'pending', 'message' => 'PayU refund status check requires manual verification'];
    }

    /**
     * Check Stripe refund status
     */
    private function checkStripeRefundStatus(Order $order): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.stripe.secret'),
            ])->get("https://api.stripe.com/v1/refunds/{$order->refund_id}");

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'status' => $data['status'],
                    'amount' => $data['amount'] / 100,
                    'gateway_data' => $data,
                ];
            }
        } catch (Exception $e) {
            Log::error("Error checking Stripe refund status: " . $e->getMessage());
        }

        return ['status' => 'error', 'message' => 'Could not check refund status'];
    }

    /**
     * Update refund status based on gateway response
     */
    public function updateRefundStatus(Order $order): void
    {
        $statusCheck = $this->checkRefundStatus($order);
        
        if (isset($statusCheck['status'])) {
            $newStatus = match($statusCheck['status']) {
                'processed', 'succeeded' => 'completed',
                'failed' => 'failed',
                'pending' => 'processing',
                default => $order->refund_status
            };

            if ($newStatus !== $order->refund_status) {
                $order->update(['refund_status' => $newStatus]);
                Log::info("Updated refund status for order {$order->id} to {$newStatus}");
            }
        }
    }
}