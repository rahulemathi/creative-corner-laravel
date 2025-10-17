<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'label', 'line1', 'line2', 'city', 'state', 'postcode', 'country', 'phone', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
