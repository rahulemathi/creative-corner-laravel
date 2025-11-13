<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OrderCustomization extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'type',
        'value',
        'metadata',
        'instructions',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * Get the full URL for image customizations
     */
    public function getImageUrlAttribute()
    {
        if ($this->type === 'image' && $this->value) {
            return Storage::url($this->value);
        }
        return null;
    }

    /**
     * Get formatted display value based on type
     */
    public function getDisplayValueAttribute()
    {
        return match($this->type) {
            'image' => $this->image_url ? 'Custom Image Uploaded' : 'No Image',
            'text' => $this->value ?: 'No Text',
            'dimensions' => $this->metadata['dimensions'] ?? 'Standard Size',
            default => $this->value ?: 'Not Specified'
        };
    }
}