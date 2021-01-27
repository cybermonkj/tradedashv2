<?php

namespace App\Exports;

use App\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;

class CouponsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Coupon::all();
    }
}
