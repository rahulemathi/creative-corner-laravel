<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customizations()
    {
        return $this->hasMany(OrderCustomization::class);
    }

    /**
     * Check if this order item has customizations
     */
    public function hasCustomizations()
    {
        return $this->customizations()->exists();
    }

    /**
     * Get image customization
     */
    public function getImageCustomization()
    {
        return $this->customizations()->where('type', 'image')->first();
    }

    /**
     * Get text customization
     */
    public function getTextCustomization()
    {
        return $this->customizations()->where('type', 'text')->first();
    }
}
