<?php

namespace App;


class Coupon extends Model
{

    protected $fillable = [
        'coupon_code',
        'price_tag',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
}
