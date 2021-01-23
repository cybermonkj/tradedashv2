<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;


class CouponController extends Controller
{
    

    public function index()
    {
        // $coupons = Coupon::all();
		
		if(Session::has('adm'))
		{
			 return view('admin.coupons');
		} else {
			return redirect('/back-end');
		}
        
       
    }

    
}
