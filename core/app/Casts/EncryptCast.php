<?php

namespace App\Casts;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class EncryptCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        try {
            $decryptedCode = Crypt::decryptString($value);
            return ! is_null($value) ? $decryptedCode : null;
        } catch (DecryptException $e) {
            return $e->getMessage();
        }
        
    }

    public function set($model, string $key, $value, array $attributes) {
        $encryptedCode = Crypt::encryptString($value);
        return [$key => ! is_null($value) ? $encryptedCode : null];
    }
}
