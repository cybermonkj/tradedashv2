<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $fillable = [
        'coupon_code',
        'price_tag',
        'is_used'
    ];

    protected $casts = [
        'is_used' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
