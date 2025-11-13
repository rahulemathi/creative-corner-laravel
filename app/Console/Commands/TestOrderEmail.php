<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Mail\OrderCancelled;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestOrderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:order-email {order_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test order cancellation email with payment method details';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->argument('order_id');
        
        if ($orderId) {
            $order = Order::find($orderId);
        } else {
            $order = Order::latest()->first();
        }
        
        if (!$order) {
            $this->error('No orders found!');
            return 1;
        }
        
        $this->info("Testing with Order #{$order->id}");
        $this->line("Payment Method: {$order->payment_method}");
        $this->line("Formatted Payment Method: {$order->formatted_payment_method}");
        $this->line("Is Online Payment: " . ($order->isPaidOnline() ? 'Yes' : 'No'));
        $this->line("Payment Status: {$order->payment_status}");
        $this->line("User Email: {$order->user->email}");
        
        if ($this->confirm('Send test cancellation email to user?', false)) {
            try {
                Mail::to($order->user->email)->send(new OrderCancelled($order));
                $this->info('✅ Email sent successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Failed to send email: ' . $e->getMessage());
            }
        }
        
        return 0;
    }
}
