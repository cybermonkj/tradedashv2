<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CouponController extends Controller
{
    

    public function index()
    {
        // $coupons = Coupon::all();
		
		if (Session::has('adm'))
		{
			 return view('admin.coupons');
		} else {
			return redirect('/back-end');
		}
        
    }
	
	public function validate(Request $request, User $user, Coupon $coupon)
	{
		// Retrieve the currently authenticated 
		$user = Auth::user();
		
		// Get the user id
		$id = Auth::id();
		
		if ($id)
		{
			return view('user.get_id_validate', [
				'id' => $id,
			]);
		} else {
			$response = "You are not logged at the moment";
			return $response;
		}
	}

    
}
