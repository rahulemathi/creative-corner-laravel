<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'sku',
        'stock',
        'dimensions',
        'length',
        'width',
        'height',
        'dimension_unit',
        'weight',
        'material',
        'images',
        'is_featured',
        'is_active',
        'is_customizable',
        'customization_options',
        'customization_price',
        'customization_instructions',
        'sort_order',
        'quantity',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'customization_price' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'images' => 'array',
        'customization_options' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_customizable' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price, 2);
    }

    public function getFormattedSalePriceAttribute()
    {
        if ($this->sale_price) {
            return '₹' . number_format($this->sale_price, 2);
        }
        return null;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    /**
     * Get total price including customization
     */
    public function getTotalPriceAttribute()
    {
        $basePrice = $this->sale_price ?: $this->price;
        return $basePrice + ($this->is_customizable ? $this->customization_price : 0);
    }

    /**
     * Check if product supports image upload customization
     */
    public function supportsImageUpload()
    {
        return $this->is_customizable && 
               $this->customization_options && 
               in_array('image_upload', $this->customization_options);
    }

    /**
     * Check if product supports text customization
     */
    public function supportsTextCustomization()
    {
        return $this->is_customizable && 
               $this->customization_options && 
               in_array('text_input', $this->customization_options);
    }

    /**
     * Check if product supports dimension customization
     */
    public function supportsDimensionCustomization()
    {
        return $this->is_customizable && 
               $this->customization_options && 
               in_array('dimensions', $this->customization_options);
    }

    /**
     * Get formatted dimensions string for display
     */
    public function getFormattedDimensionsAttribute()
    {
        if ($this->length && $this->width && $this->height) {
            return $this->length . ' x ' . $this->width . ' x ' . $this->height . ' ' . ($this->dimension_unit ?: 'cm');
        }
        
        return $this->dimensions; // Fallback to old dimensions field
    }

    /**
     * Check if product has admin-defined dimensions (not customer customizable)
     */
    public function hasFixedDimensions()
    {
        return !$this->supportsDimensionCustomization() && 
               ($this->length || $this->width || $this->height || $this->dimensions);
    }
} 