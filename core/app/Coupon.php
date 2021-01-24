<?php

namespace App;


class Coupon extends Model
{

    protected $fillable = [
        'coupon_code',
        'price_tag',
        'is_used',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
}
