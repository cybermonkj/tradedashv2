<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Casts\EncryptCast;

class deposits extends Model
{
    protected $table="deposits";

    protected $casts = [
        'account_name' => EncryptCast::class,
        'account_no' => EncryptCast::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
