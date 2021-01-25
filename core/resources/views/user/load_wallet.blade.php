@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
        <div class="main-panel">
            <div class="content">
                @php($breadcome = 'Wallet')
                @include('user.atlantis.main_bar')
                <div class="page-inner mt--5">
                    @include('user.atlantis.overview')
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('Fund your wallet') }}</div>
                                        <div class="container">
                                            Session message:
                                            <div class="card">
                                               <strong>{{ session('mssg') }}</strong>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="card-body"> 
                                        @if($user->status == 2 || $user->status == 'Blocked')
                                            <div class="alert alert-warning">
                                                <p>
                                                   {{ __('Account Blocked or restricted! This Might be because of a breach in usage policy. if you think this was a Mistake, Please contact support for assistance. We apologize for any inconveniency.') }} 
                                                </p>
                                            </div>
                                        @elseif(empty($user->currency))
                                            <div class="alert alert-warning">
                                                <p>
                                                    <a href="/{{$user->username}}/profile#userdet">
                                                        {{ __('Please, update your Tradepander profile before you proceed') }}
                                                    </a>
                                                </p>
                                            </div>
                                        @else
                                            @if($settings->deposit == 1)      
                                                <div id="pay_cont" class="row">
                                                    @if(env('SWITCH_PAYPAL') == 1)
                                                    <div class="mt-5 col-lg-6">                                                        
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-cc-paypal fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund with paypal') }}
                                                            </p>
                                                            <div align="">
                                                                <a href="{{ route('addmoney.paywithpaypal') }}" class="btn btn_blue" >{{ __('Continue to Payment') }}</a>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endif
                                                    @if(env('SWITCH_STRIPE') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                                                  
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-cc-stripe fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund with Stripe payment gateway') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('stripe.amount') }}" class="btn btn_blue" >
                                                                    {{ __('Fund with Stripe') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('PM_SWITCH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <img src="/img/pm.png" height="50px"></img> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund using Perfect Money') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('pm.index') }}" class="btn btn_blue" >
                                                                    {{ __('Pay with PM') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                   
                                                    @if(env('PAYEER_SWITCH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <img src="/img/payeer.png" height="50px"></img> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund with Payeer gateway') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('payeer.index') }}" class="btn btn_blue" >
                                                                    {{ __('Pay with Payeer') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('SWITCH_BTC') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund using Bitcoin') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('btc.index', ['coin' => 'BTC']) }}" class="btn btn_blue" >
                                                                    {{ __('Fund with BTC') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('COINBASE_SWITCH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                    
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund using Coinbase Crypto payment system') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('coinbase.index') }}" class="btn btn_blue" >
                                                                    {{ __('Fund with Coinbase') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('SWITCH_ETH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-ethereum fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund using Ethereum') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('btc.index', ['coin' => 'ETH']) }}" class="btn btn_blue" >
                                                                    {{ __('Fund with ETH') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('PAYSTACK_SWITCH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <img src="https://website-v3-assets.s3.amazonaws.com/assets/img/hero/Paystack-mark-white-twitter.png" height="50px"></img> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund using Card') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('paystack.index') }}" class="btn btn_blue" >
                                                                    {{ __('Process with Paystack') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if(env('BANK_DEPOSIT_SWITCH') == 1)
                                                    <div class="mt-5 col-lg-6">                                                                    
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="far fa-building fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Fund with Deposit Code') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a id="pay_with_bank_dep" href="javascript:void(0)" class="btn btn_blue" >
                                                                    {{ __('Use Deposit Code') }}
                                                                </a>
                                                            </div> 
                                                            <div id="bank_dets" align="" class="cont_display_none">
                                                                <div class="mt-5 border rounded row border-primary">              
                                                                    <div class="col-sm-12">
                                                                        <h3 class="color_blue_b">
                                                                            <i class="fas fa-money-check-alt color_blue_9"></i> {{env('ACCOUNT_NAME')}}
                                                                        </h3>
                                                                       <!-- <h4 class="text-danger">Auto Verification: {{env('ACCOUNT_NUMBER')}}</h4>
                                                                        <h5 class="">Average Response time: {{env('BANK_NAME')}}</h5> -->
																		<p>
																		<a href="https://tradepander.com/buy-tradepander-deposit-code"  class="btn btn_blue">Find Deposit code vendors</a> </p>
                                                                          
																		
                                                                    </div>
                                                                </div>
                                                                <div class="row">              
                                                                    <div class="col-sm-12">
                                                                        	<p> {{ __('After Submitting a Deposit code, Please wait while system Verifies Your Deposit code') }} 
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">              
                                                                    <div class="col-sm-12">
                                                                        <a id="bank_deposit_cont" href="javascript:void(0)" class="btn btn_blue" >
                                                                            {{ __('Proceed') }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>                                                                                               
                                                        </div>                                                       
                                                    </div>
                                                    @endif


                                                </div>                                                   
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-12">                                                                       
                                                        <div class="payment_method">
                                                            <p align="Center">
                                                               <i class="fa fa-alert"></i> {{ __('Deposit is temporarilly disabbled, Please wait while we update the system') }} 
                                                            </p>                              
                                                        </div>                                                       
                                                    </div>
                                                </div>      
                                            @endif                                         

                                        @endif

                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{ __('Deposit History') }}</div>
                                </div>
                                <div class="pb-0 card-body">
                                    <?php
                                        $deps = App\deposits::where('user_id', $user->id)->orderby('id', 'desc')->paginate(10);
                                    ?>                                                   
                                                
                                    <div class="table-responsive">
                                        <table class="table display table-striped table-hover" >
                                        <thead>
                                            <tr>  
                                                <th>{{ __('Amount') }}</th>        
                                                <th>{{ __('Method') }}</th>
                                                <th>{{ __('Account/Code/Haash') }}</th>
                                                <th>{{ __('Acc/Deposit Code') }}</th>
                                                <th>{{ __('Date') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Url') }}</th>                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if(count($deps) > 0 )
                                                @foreach($deps as $dep)
                                                    <tr> 
                                                        <td>{{$settings->currency}} {{$dep->amount}}</td>     
                                                        <td>{{$dep->bank}}</td>
                                                        <td>
                                                           {{$dep->account_no}}
                                                        </td>
                                                        <td>
                                                           {{$dep->account_name}}
                                                        </td>
                                                        <td>{{$dep->created_at}}</td>
                                                        <td>
                                                            @if($dep->status == 0)
                                                                Pending
                                                            @elseif($dep->status == 1)
                                                                Approved
                                                            @elseif($dep->status == 2)
                                                                Rejected
                                                            @endif
                                                        </td> 
                                                        <td>
                                                            @if($dep->bank == 'BTC')
                                                                @if($dep->account_name == 'Coin Base')
                                                                    <a href="{{ route('coinbase.confirm', ['id' => $dep->pop]) }}" target="_blank" class="btn btn-info">Check</a>
                                                                @else
                                                                    <a href="{{ route('btc.confirm', ['id' => $dep->account_name]) }}" target="_blank" class="btn btn-info">Check</a>
                                                                @endif
                                                            @endif
                                                        </td>                                                                       
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>                                                            
                                                    <td colspan="6">{{ __('Empty Data') }}</td>                                        
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $deps->links() }}
                                    </div>           
                                    <br><br>  
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            @include('user.inc.confirm_inv')
            <div id="dep_pop" class="container dep_pop">
                <div class="row pad_5p2p">
                    <div class="col-md-4">&emps;</div>
                    <div class="col-md-4 pop_cont" align="Center">   
                        <div class="">                        
                                <span>            
                                  <a id="dep_pop_close" href="javascript:void(0)" class="btn btn-danger">{{ __('Cancel') }}</a>        
                                </span>
                                <br>
                            </div>
                            <div>
                                <img id="img_pop" src="" class="pop_img_h">
                            </div>
                            <br>
                        </div>  
                        <!-- close btn -->
                        <script type="text/javascript">
                          $('#dep_pop_close').click( function(){
                            $('#dep_pop').hide();
                          });        
                        </script>
                        <!-- end close btn -->
                    </div>
                </div>
            </div>

            <div id="bank_deposit_cont_dets" class="container popmsgContainer" >
                <div class="row">
                  <div class="col-md-4">&emps;</div>
                  <div class="col-md-4 popmsg-mobile card" align="Center">        
                    <div class="mt-2">
                      <h3><b>{{ __('Deposit Details') }}</b></h3>                              
                      <hr>
                    </div>
                    <div class="">                        
                        <form action="/user/wallet/coupon_deposit" method="get">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend ">
                                  <span class="input-group-text span_bg">{{$settings->currency}}</span>
                                </div>                        
                                <input type="number" class="form-control" name="amt" value="30" required placeholder="Amount" >
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group" >                   
                                <div class="input-group-prepend " >
                                  <span class="input-group-text span_bg"><i class="fa fa-user" ></i></span>
                                </div>
                                <input type="text" class="form-control" name="deposit_code"  required placeholder="Deposit Code" >
                              </div>
                            </div>
                            <div class="container">
                                <div class="form-group">
                                    <input type="submit" value="submit" class="btn btn-info">
                                    <a id="bank_deposit_cont_dets_close" href="javascript" class="collcc btn btn-danger">{{ __('Cancel') }}</a>
                                </div>
                            </div>
						
                            {{-- <div class="form-group">
                              <br>
                                <button type="submit" class="collb btn btn-info">Submit</button>
                                <span style="">            
                                  <a id="bank_deposit_cont_dets_close" href="javascript" class="collcc btn btn-danger">{{ __('Cancel') }}</a>        
                                </span>
                                <br>
                            </div> --}}
                        </form>
                    </div>  
                    <!-- close btn -->
                    {{-- <script type="text/javascript">
                      $('#bank_deposit_cont_dets_close').click( function(){
                        $('#bank_deposit_cont_dets').hide();
                      });        
                    </script> --}}
                    <!-- end close btn -->
                  </div>

                </div>
            </div>            
@endSection
            