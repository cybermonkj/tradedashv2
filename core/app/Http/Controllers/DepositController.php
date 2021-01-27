<?php

namespace App\Http\Controllers;

use App\User;
use App\deposits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use DotenvEditor;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendRoute()
    {
        return view('user.components.deposit_modal');
    }

    public function validateDeposit(Request $request)
    {
        $user = Auth::user();
        // $inputAmt = $request->input('amount');
        // $inputCode = $request->input('deposit_code');

        if (Auth::check()) {
            if($request->input('amount') < env('MIN_DEPOSIT') && $request->input('amount') > env('MAX_DEPOSIT')) {
                return back()->with('err_msg', 'Amount less than 30$');
            } else {
                $coupon = DB::table('coupons')->where('coupon_code', $request->input('deposit_code'))->first();
                if(!empty($coupon)) {
                    // Check used status of coupon
                    if ($coupon->is_used != true) {
                        // Update coupon status to sold
                        try {
                            DB::table('coupons')
                            ->where('id', $coupon->id)
                            ->update(['is_used' => true]);

                            // Validate and execute deposit

                            // Check if Bank Records Exists
                            $bank=  DB::table('bank')->where('user_id', Auth::id())->first();

                            if(!empty($bank))
                            {
                                try {
                                    $depositHist = new deposits;
                                    $depositHist->user_id = Auth::id();
                                    $depositHist->deposit_id = ($Auth::id().'_'.$coupon->id.'_'.$bank->id); //User ID _ Coupon ID _ Bank ID for relational reasons
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $request->input('amount');
                                    $depositHist->acct_name = $bank->Account_name;
                                    $depositHist->acct_no = $bank->Account_number;
                                    $depositHist->currency = '$';
                                    $depositHist->bank = $bank->Bank_Name;
                                    $depositHist->url = null;
                                    $depositHist->status = $coupon->is_used;
                                    $depositHist->on_apr = 0;
                                    $depositHist->ipn = 0;
                                    $depositHist->pop = null;
    
                                    // Save to DB
                                    $depositHist->save();
                                } catch (Exception $e) {
                                    return back()->with('err_msg', ('Deposit history not saved! '.$e->getMessage()));
                                }
                            }  else {
                                try {
                                    $st = site_settings::find(1);
                                    $depositHist = new deposits;
                                    $depositHist->user_id = Auth::id();
                                    $depositHist->deposit_id = ($Auth::id().'_'.$coupon->id.'_'.$bank->id); //User ID _ Coupon ID _ Bank ID for relational reasons
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $request->input('amount');
                                    $depositHist->acct_name = "Account Name";
                                    $depositHist->acct_no = "Account Number";
                                    $depositHist->currency = '$';
                                    $depositHist->bank = "Bank";
                                    $depositHist->url = null;
                                    $depositHist->status = $coupon->is_used;
                                    $depositHist->on_apr = 0;
                                    $depositHist->ipn = 0;
                                    $depositHist->pop = null;
    
                                    // Save to DB
                                    $depositHist->save();
                                } catch (Exception $e) {
                                    return back()->with('err_msg', ('Deposit history not saved! '.$e->getMessage()));
                                }
                            }

                            
                            return back()->with('success', 'Coupon status updated');
                        } catch (Exception $e) {
                            return back()->with('err_msg', ('The deposit you enterred is not found! '.$e->getMessage()));
                        }
                    } else {
                        return back()->with('err_msg', 'Coupon code has already been used!');
                    }
                    
                    
                } else {
                    return back()->with('mssg', 'The coupon code you entered is invalid');
                }
            }
        } else {
            return redirect('/login')->back()->with('err_msg', "You are not logged in at the moment!");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
