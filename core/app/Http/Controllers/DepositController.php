<?php

namespace App\Http\Controllers;

use App\User;
use App\deposits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

                            // Validate and execute 

                            

                            // Check if Bank Records Exists
                            $bank=  DB::table('bank')->where('user_id', Auth::id())->first();

                            if(!empty($bank))
                            {
                                try {
                                    $depositHist = new deposits;
                                    $depositHist->user_id = $user->id;
                                    $depositHist->deposit_id = ($user->id .'_'. $coupon->id .'_'. $bank->id);
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $request->input('amount');
                                    $depositHist->acct_name = $bank->Account_name;
                                    $depositHist->acct_no = $bank->Account_number;
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
                                        session::put('status', "Deposit fail");
                                        session::put('msgType', "err");
                                    } 
                                    else
                                    {
                                        
                                        try {
                                            $usr = deposits::find(Auth::id());         
                                            if($usr->status == 1)
                                            {
                                            return back()->with([
                                                'toast_msg' => 'Deposit already approved!',
                                                'toast_type' => 'err'
                                            ]);
                                            }
                                            
                                            $dep_user = User::find($usr->user_id); 
                                            $amt = $usr->amount;  
                                            
                                            if($usr->on_apr == 0)
                                            {
                                                $dep_user->wallet += $amt;
                                                $dep_user->save();
                                            }
                                            $usr->status = 1;
                                            $usr->on_apr = 1;
                                            $usr->save();
                                            
                                            // $adm = Session::get('adm'); 
                                            $act = new adminLog;
                                            $act->admin = "Automatically Approved";
                                            $act->action = "System Approved user deposit. Deposit id: ".$id;
                                            $act->save();

                                            return back()->with([
                                            'toast_msg' => 'Deposit approved successfully!',
                                            'toast_type' => 'suc'
                                            ]);
                                                            
                                        }
                                        catch(\Exception $e)
                                        {
                                            return back()->with([
                                            'toast_msg' => "Deposit not successful!",
                                            'toast_type' => 'err'
                                            ]);
                                            return back();
                                        }
                                        // End approval logic
                                    }
                                } catch (Exception $e) {
                                    return back()->with('err_msg', "Deposit code note saved");
                                    // session::put('status', ("Deposit not successful".$e->getMessage()));
                                    // session::put('msgType', "err");
                                }
                            }  
                            else {
                                try {
                                    $depositHist = new deposits;
                                    $depositHist->user_id = $user->id;
                                    $depositHist->deposit_id = ($user->id .'_'. $coupon->id .'_'. 'null');
                                    $depositHist->usn = ($user->firstname .' '. $user->lastname);
                                    $depositHist->amount = $request->input('amount');
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
                                         session::put('status', "Deposit fail");
                                         session::put('msgType', "err");
                                     } 
                                     else
                                     {
                                         
                                        try {
                                            $usr = deposits::find(Auth::id());         
                                            if($usr->status == 1)
                                            {
                                            return back()->with([
                                                'toast_msg' => 'Deposit already approved!',
                                                'toast_type' => 'err'
                                            ]);
                                            }
                                            
                                            $dep_user = User::find($usr->user_id); 
                                            $amt = $usr->amount;  
                                            
                                            if($usr->on_apr == 0)
                                            {
                                                $dep_user->wallet += $amt;
                                                $dep_user->save();
                                            }
                                            $usr->status = 1;
                                            $usr->on_apr = 1;
                                            $usr->save();
                                         
                                            
                                            // $adm = Session::get('adm'); 
                                            $act = new adminLog;
                                            $act->admin = "Automatically Approved";
                                            $act->action = "System Approved user deposit. Deposit id: ".$id;
                                            $act->save();

                                            return back()->with([
                                            'toast_msg' => 'Deposit approved successfully!',
                                            'toast_type' => 'suc'
                                            ]);             
                                         }
                                         catch(\Exception $e)
                                         {
                                             return back()->with([
                                             'toast_msg' => "Deposit not successful!",
                                             'toast_type' => 'err'
                                             ]);
                                             return back();
                                         }
                                         // End approval logic
                                    }
                                    // End of approval logic
                                } catch (Exception $e) {
                                    return back()->with('err_msg', ('Deposit history not saved! '.$e->getMessage()));
                                    // session::put('status', ("Deposit not successful".$e->getMessage()));
                                    // session::put('msgType', "err");
                                }
                            }
                            return back()->with('success', 'Coupon status updated');
                            // session::put('status', ("Coupon status updated".$e->getMessage()));
                            // session::put('msgType', "suc");
                        } catch (Exception $e) {
                            return back()->with('err_msg', ('The deposit code you enterred is not found! '.$e->getMessage()));
                            // session::put('status', ("The deposit code you enterred is not found! ".$e->getMessage()));
                            // session::put('msgType', "err");
                        }
                    } else {
                        return back()->with('err_msg', 'Coupon code has already been used!');
                        // session::put('status', "Deposit code has already been used! ");
                        // session::put('msgType', "err");
                    }
                } else {
                    return back()->with('mssg', 'The coupon code you entered is invalid');
                    // session::put('status', "Invalid deposit code ");
                    // session::put('msgType', "err");
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
