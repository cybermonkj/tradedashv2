<?php

namespace App\Http\Controllers;

use App\User;
use App\deposits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

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
            if($request->input('amount') < env('MIN_DEPOSIT')) {
                return back()->with([
                    'toast_msg' => 'Amount less than 30$',
                    'toast_type' => 'err'
                ]);
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

                            // Check if Bank Records Exists
                            $bank=  DB::table('bank')->where('user_id', Auth::id())->first();

                            if(!empty($bank))
                            {
                                try {
                                    $depositHist = new deposits;
                                    $depositHist->user_id = $user->id;
                                    $depositHist->deposit_id = ($user->id .'_'. $coupon->id .'_'. $bank->id);
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $coupon->price_tag;
                                    $depositHist->account_name = $bank->Account_name;
                                    $depositHist->account_no = $bank->Account_number;
                                    $depositHist->currency = DB::table('settings')->where('id', 1)->value('currency');
                                    $depositHist->bank = $bank->Bank_Name;
                                    $depositHist->transaction_type = null;
                                    $depositHist->url = "";
                                    $depositHist->status = true;
                                    $depositHist->on_apr = true;
                                    $depositHist->ipn = 0;
                                    $depositHist->pop = "";
    
                                    // Save to DB
                                    $depositHist->save();
                                    $saved = $depositHist->save();

                                    if (!$saved) {
                                        return back()->with([
                                            'toast_msg' => 'Deposit fail',
                                            'toast_type' => 'err'
                                        ]);
                                    } 
                                    else
                                    {
                                        try {
                                            $is_update = DB::table('users')
                                                            ->where('id', Auth::id())
                                                            ->increment('wallet', DB::table('coupons')->where('coupon_code', $request->input('deposit_code'))->value('price_tag'));

                                            if ($is_update) {
                                                return back()->with([
                                                    'toast_msg' => 'Deposit approved successfully!',
                                                    'toast_type' => 'suc'
                                                ]);
                                            }
                                        } catch (\Exception $e) {
                                            return back()->with([
                                                'toast_msg' => "Deposit not successful!",
                                                'toast_type' => 'err'
                                            ]);
                                        }
                                        // End approval logic
                                    }
                                } catch (Exception $e) {
                                    return back()->with([
                                        'toast_msg' => 'Deposit code note saved',
                                        'toast_type' => 'err'
                                    ]);
                                }
                            }  
                            else {
                                try {
                                    $depositHist = new deposits;
                                    $depositHist->user_id = $user->id;
                                    $depositHist->deposit_id = ($user->id .'_'. $coupon->id .'_'. 'no_bank');
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $coupon->price_tag;
                                    $depositHist->account_name = "";
                                    $depositHist->account_no = "";
                                    $depositHist->currency = DB::table('settings')->where('id', 1)->value('currency');
                                    $depositHist->bank = "Bank";
                                    $depositHist->transaction_type = null;
                                    $depositHist->url = "";
                                    $depositHist->status = true;
                                    $depositHist->on_apr = true;
                                    $depositHist->ipn = 0;
                                    $depositHist->pop = "";
    
                                    // Save to DB
                                    $depositHist->save();

                                     // Save to DB
                                     $depositHist->save();
                                     $saved = $depositHist->save();
 
                                     if (!$saved) {
                                        return back()->with([
                                            'toast_msg' => 'Deposit fail',
                                            'toast_type' => 'err'
                                        ]);
                                     } 
                                     else
                                     {
                                        try {
                                            $is_update = DB::table('users')
                                                            ->where('id', Auth::id())
                                                            ->increment('wallet', DB::table('coupons')->where('coupon_code', $request->input('deposit_code'))->value('price_tag'));

                                            if ($is_update) {
                                                // Send email
                                                // $maildata = ['email' => $user->email, 'username' => $user->username];
                                                // Mail::send('mail.user_deposit_notification', ['md' => $maildata], function($msg) use ($maildata){
                                                //     $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
                                                //     $msg->to($maildata['email']);
                                                //     $msg->subject('User Deposit Notification');
                                                // });

                                                // Mail::send('mail.admin_deposit_notification', ['md' => $maildata], function($msg) use ($maildata){
                                                //     $msg->from(env('MAIL_USERNAME'), env('APP_NAME'));
                                                //     $msg->to(env('SUPPORT_EMAIL'));
                                                //     $msg->subject('User Deposit Notification');
                                                // });

                                                return back()->with([
                                                    'toast_msg' => 'Deposit approved successfully!',
                                                    'toast_type' => 'suc'
                                                ]);
                                            }
                                        } catch (\Exception $e) {
                                            return back()->with([
                                                'toast_msg' => "Deposit not successful!",
                                                'toast_type' => 'err'
                                            ]);
                                        }
                                    }
                                } catch (\Exception $e) {
                                    return back()->with([
                                        'toast_msg' => 'Deposit history not saved!',
                                        'toast_type' => 'err'
                                    ]);
                                }
                            }
                            return back()->with([
                                'toast_msg' => 'Deposit Verified',
                                'toast_type' => 'suc'
                            ]);
                        } catch (Exception $e) {
                            return back()->with([
                                'toast_msg' => 'The deposit code you enterred is not found!',
                                'toast_type' => 'err'
                            ]);
                        }
                    } else {
                        return back()->with([
                            'toast_msg' => 'Deposit code has already been used!',
                            'toast_type' => 'err'
                        ]);
                    }
                } else {
                    return back()->with([
                        'toast_msg' => 'Invalid deposit code',
                        'toast_type' => 'err'
                    ]);
                }
            }
        } else {
            return redirect('/login')->back()->with([
                'toast_msg' => 'You are not logged in',
                'toast_type' => 'err'
            ]);
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
