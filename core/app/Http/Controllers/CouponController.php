<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CouponsImport;
use App\Exports\CouponsExport;


class CouponController extends Controller
{
    

    public function index()
    {
		if (Session::has('adm'))
		{
			$coupons = Coupon::all();
			return view('admin.coupon_code', [
				'coupons' => $coupons,
			]);
		} else {
			return redirect('/back-end');
		}
        
    }

	public function import()
    {
        return view('admin.upload');
    }

	public function importCouponFile(Request $request)
    {
		$request->validate([
			'coupon_code' => 'required|unique:coupons|min:8|max:9',
		]); 

		if ($request->file('myFile') == null) {
			return back()->with('err', 'You did not upload any file');
		} else {

			Excel::import(new CouponsImport, $request->file('myFile')->store('temp'));
        	return back()->with('success', 'Coupon codes uploaded successfully!');
		}
    }

	public function exportCouponFile()
    {
        return Excel::download(new CouponsExport, 'coupons-list.xlsx');
    }
    
}
