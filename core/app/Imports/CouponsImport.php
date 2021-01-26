<?php

namespace App\Imports;

use App\Coupon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CouponsImport implements ToModel, WithChunkReading, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Coupon([
            'coupon_code'    => $row['coupon_code'],
            'is_used'    => $row['status'],
        ]);
    }

    public function chunkSize():int
    {
        return 1000;
    }
}
