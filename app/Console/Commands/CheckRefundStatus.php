<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\RefundService;
use Illuminate\Console\Command;

class CheckRefundStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refunds:check-status {--order-id= : Check specific order ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update refund statuses for pending refunds';

    protected $refundService;

    public function __construct(RefundService $refundService)
    {
        parent::__construct();
        $this->refundService = $refundService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->option('order-id');
        
        if ($orderId) {
            // Check specific order
            $order = Order::find($orderId);
            if (!$order) {
                $this->error("Order #{$orderId} not found.");
                return 1;
            }
            
            $this->checkOrderRefund($order);
        } else {
            // Check all orders with pending refunds
            $orders = Order::whereNotNull('refund_id')
                          ->whereIn('refund_status', ['initiated', 'processing'])
                          ->get();
            
            $this->info("Found {$orders->count()} orders with pending refunds.");
            
            foreach ($orders as $order) {
                $this->checkOrderRefund($order);
            }
        }
        
        $this->info('Refund status check completed.');
        return 0;
    }

    private function checkOrderRefund(Order $order)
    {
        $this->line("Checking refund for Order #{$order->id}...");
        
        try {
            $this->refundService->updateRefundStatus($order);
            $order->refresh();
            
            $this->info("Order #{$order->id}: Refund status updated to '{$order->refund_status}'");
        } catch (\Exception $e) {
            $this->error("Order #{$order->id}: Error checking refund status - " . $e->getMessage());
        }
    }
}
