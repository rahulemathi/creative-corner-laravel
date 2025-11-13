<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_status_id',
        'total_amount',
        'payment_method',
        'payment_gateway',
        'payment_id',
        'payment_status',
        'payment_details',
        'refund_amount',
        'refund_status',
        'refund_id',
        'refund_processed_at',
        'shipping_address',
        'order_date',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'payment_details' => 'array',
        'refund_processed_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if the order was paid online
     */
    public function isPaidOnline(): bool
    {
        return in_array($this->payment_method, ['online', 'card', 'upi', 'wallet', 'netbanking']);
    }

    /**
     * Check if the order is eligible for automatic refund
     */
    public function isEligibleForRefund(): bool
    {
        return $this->isPaidOnline() && 
               $this->payment_status === 'paid' && 
               in_array($this->refund_status, [null, 'failed']);
    }

    /**
     * Get formatted payment method name
     */
    public function getFormattedPaymentMethodAttribute(): string
    {
        return match($this->payment_method) {
            'cod' => 'Cash on Delivery',
            'online' => 'Online Payment',
            'card' => 'Credit/Debit Card',
            'upi' => 'UPI Payment',
            'wallet' => 'Digital Wallet',
            'netbanking' => 'Net Banking',
            default => ucfirst($this->payment_method ?? 'Unknown')
        };
    }

    /**
     * Get refund status badge color
     */
    public function getRefundStatusColorAttribute(): string
    {
        return match($this->refund_status) {
            'initiated' => 'yellow',
            'processing' => 'blue',
            'completed' => 'green',
            'failed' => 'red',
            default => 'gray'
        };
    }
}
