@extends('admin.atlantis.layout')
@Section('content')
        <div class="main-panel">
            <div class="content">
                @include('admin.atlantis.main_bar')
                <div class="page-inner mt--5 ">
                  <div id="prnt"></div>
                  <div class="row">
                    <div class="col-sm-12 card">
                      <form id="settings_form" action="/admin/update/site/settings" method="post">
                        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">General</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Deposit</a>
                          </li>
							<li class="nav-item">
                            <a class="nav-link" id="referral-tab" data-toggle="pill" href="#referral" role="tab" aria-controls="pills-contact" aria-selected="false">Referral</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="mail_settings-tab" data-toggle="pill" href="#mail_settings" role="tab" aria-controls="pills-contact" aria-selected="false">Email (SMTP)</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#payment_setting_tab" role="tab" aria-controls="pills-contact" aria-selected="false">Payment Settings</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Withdrawal</a>
                          </li>
                          
                          
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                          <div class="p-5 tab-pane fade show active" id="pills-home" role="tabpanel" >
                            <div class="form-group">                                            
                              <div class="row">                                                
                                <div class="col-md-6" align="">
                              <!-- <h3><i class="fas fa-feather-alt"></i> {{ __('Header Color') }} </h3> -->
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                               <!--  <input id="input_hcolor" value="{{$settings->header_color}}" class="p-0 color_picker float-left with_50per" type="color"  name="hcolor" required > -->
                                </div>                                   
                                <div class="col-md-6" align="">
                                   <!--  <h3><i class="fas fa-feather-alt"></i> {{ __('Footer Color') }} </h3>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="input_fcolor" value="{{$settings->footer_color}}" class="p-0 color_picker float-left with_50per" type="color"  name="fcolor" required >
                                </div>                                                
                              </div>  -->
                              <br><br>
                              <hr>
                              <div class="row margin_top50"> 
                                 <!-- <div class="col-md-6">
                                      <h3><i class="fab fa-centercode"></i> {{ __('Site Logo') }} </h3>
                                      <input type="file" name="siteLogo" class=" btn btn-info border_none" >
                                  </div>                                               
                                  <div class="col-md-6" align="center"> 
                                        <img src="/img/{{$settings->site_logo}}" alt="Logo" class="height_50" align="center" >
                                  </div>                                                
                              </div> -->
                              <br><br>
                              <hr>

                              <div class="row margin_top50"> 
                                 <!-- <div class="col-md-6">
                                      <h3><i class="fas fa-thumbtack"></i> {{ __('Site Title') }} </h3>
                                      <input type="text" name="siteTitle" value="{{$settings->site_title}}" class="form-control" placeholder="Site Name" required >
                                  </div>  -->
                                 <!-- <div class="col-md-6">
                                      <h3><i class="fas fa-pen"></i> {{ __('Site Description') }} </h3>
                                      <input type="text" name="siteDescr" value="{{$settings->site_descr}}" class="form-control" placeholder="Site Description" required>
                                  </div>  -->
                              </div>
                              <div class="row margin_top50">
                               <div class="col-md-8">
                                      <h3><i class="fas fa-envelope"></i> {{ __('Support Email') }} </h3>
                                      <input type="text" name="supEmail" value="{{env('SUPPORT_EMAIL')}}" class="form-control" placeholder="Support Email" required>
                                  </div>
                              </div> 
                              <br>
                              <div class="row margin_top50"> 
                                <div class="col-md-4">
                                    <h3><i class="fas fa-hand-holding-usd"></i> {{ __('Enable Investment system') }}  </h3>
                                </div>                                               
                                <div class="col-md-8" align="right">
                                    <b>Enable/Disable</b><br>               
                                    <label class="switch">
                                      <input id="inv" type="checkbox" name="inv"  value="{{$settings->investment}}" @if($settings->investment == 1){{'checked'}}@endif>
                                      <span id="" class="slider round" onclick="checkedOnOff('inv')"></span>
                                    </label> 
                                </div>                                                
                              </div>

                              <div class="row margin_top50"> 
                                  <div   class="col-md-4">
                                      <h3> <i class="fas fa-user"></i> {{ __('Enable User Registration') }} </h3>
                                  </div>                                               
                                  <div class="col-md-8" align="right">
                                      <b>Enable/Disable</b><br>
	
                                      <label class="switch">
                                        <input id="reg" type="checkbox" name="reg" value="{{$settings->user_reg}}" @if($settings->user_reg == 1){{'checked'}}@endif>
                                        <span id="" class="slider round" onclick="checkedOnOff('reg')"></span>
                                      </label> 
                                  </div>                                                
                              </div>
                              <br><br>
                              <hr>
                              <div class="row margin_top50">                                                                                               
                                 <!-- <div class="col-md-12" >
                                      <h3><i class="fa fa-coggs"></i> {{ __('Currency Settings') }} </h3>
                                  </div>
                                  <div   class="col-md-6 ">
                                      <div class="card pad_20" >
                                          <h5> {{ __('Currency symbol/Code') }} </h5>
                                          <input type="text" name="cur" value="{{$settings->currency}}" class="form-control" placeholder="currency symbol or code" required >
                                      </div>
                                  </div> 
                                  <div   class="col-md-6">
                                      <div class="card form-group pad_20" >
                                          <h5> {{ __('Currency Rate to US Dollar') }} </h5>
                                          <input type="text" name="cur_conv" value="{{$settings->currency_conversion}}" class="form-control" placeholder="Currency conversion rate to dollar" required >
                                      </div>
                                  </div>                                            
                              </div> 

                            </div>
                          </div> -->

                          <div class="p-5 tab-pane fade" id="pills-profile" role="tabpanel" >
                            <div class="row"> 
                                <div class="col-md-6">
                                    <h5> {{ __('Minimum Deposit (').$settings->currency.__(')') }} </h5>
                                    <input type="number" name="min_dep" value="{{env('MIN_DEPOSIT')}}" class="form-control" placeholder="Minimum deposit" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <h5> {{ __('Maximum Deposit (').$settings->currency.__(')') }} </h5>
                                    <input type="number" name="max_dep" value="{{env('MAX_DEPOSIT')}}" class="form-control" placeholder="Maximum deposit" step="1" required>
                                </div> 
                                <div class="col-md-12 mt-3" align="right"> 
                                    <b>Enable/Disable</b><br>             
                                    <label class="switch">
                                      <input id="wallet" type="checkbox" name="wallet"  value="{{$settings->deposit}}" @if($settings->deposit == 1){{'checked'}}@endif>
                                      <span id="" class="slider round" onclick="checkedOnOff('wallet')"></span>
                                    </label>
                                </div>                                       
                            </div>
                          </div>

                          <div class="p-5 tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">                            
                            <div class="row"> 
                              <div class="col-sm-6">
                                <h5> {{ __('Minimum Withdrawal') }} </h5>
                                <input type="number" name="min_wd" value="{{env('MIN_WD')}}" class="form-control" placeholder="Enter value" >
                              </div>
                              <div class="col-sm-6">
                                <h5> {{ __('Withdrawal Limit') }} </h5>
                                <input type="number" name="wd_limit" value="{{env('WD_LIMIT')}}" class="form-control" placeholder="Enter value" >
                              </div> 
                                                                    
                              <div class="col-sm-12 mt-3">
                                <h5> {{ __('Withdrawal Fee. (Exp. 2 means 2%)') }} </h5>
                                <input type="number" name="wd_fee" value="{{env('WD_FEE')*100}}" class="form-control" placeholder="Enter value" >
                              </div> 
                                                                                                         
                              <div class="col-md-12 mt-2" align="right">
                                <b>Enable/Disable</b><br>               
                                <label class="switch">
                                  <input id="wd" type="checkbox" name="wd" value="{{$settings->withdrawal}}" @if($settings->withdrawal == 1){{'checked'}}@endif>
                                  <span id="" class="slider round" onclick="checkedOnOff('wd')"></span>
                                </label> 
                              </div> 
                            </div>                                              
                          </div>

                          <div class="tab-pane fade p-5" id="referral" role="tabpanel" aria-labelledby="referral-tab">
                            
                            <div class="row ">                                 
                                <div class="col-sm-6">
                                    <h5></i> {{ __('Referral System') }} </h5>
                                       <select id="referal_system" class="form-control" name="referal_system" >
                                        @if(env('REF_SYSTEM') == 'Single_level' )
                                            <option value="Single_level" selected>Disabled</option>
                                            <option value="Multi_level">Enabled</option>
                                        @else
                                            <option value="Single_level">Disabled</option>
                                            <option value="Multi_level" selected>Enabled</option>
                                        @endif
                                    </select>                                   
                                </div>
                                
                                                                <div class="col-sm-6">
                                    <h5></i> {{ __('Referral Type') }} </h5>
                                     <select class="form-control" name="referal_type" >
                                        @if(env('REF_TYPE') == 'Once')
                                            <option value="Once" selected>Once (1st investment only)</option>
                                            <option value="Continous">Continous (for every investment)</option>
                                        @else
                                            <option value="Once">Once (1st investment only)</option>
                                            <option value="Continous" selected>Continous (for every investment)</option>
                                        @endif
                                    </select> 
                                </div>

                            </div>

                            <div id="Multi_level_settings" class="@if(env('REF_SYSTEM') != 'Multi_level'){{__('cont_display_none')}}@endif">
                              <div class="row mt-5">
                                  <div class="col-sm-6">                                    
                                    <h6> {{ __('Referral Levels (Enter Number)') }} </h6>
                                    <input type="number" name="referal_levels" value="{{env('REF_LEVEL_CNT')}}" class="form-control" onkeyup="set_inputs(this.value)" > 
                                    <small class="font_11">Enter 1 for Single Level</small>

                                  </div>                                                 
                              </div> 

                              <div id="warning_div" class="row mt-5">
                                <div class="col-sm-12 alert alert-warning text-center">Note: Entering '4' means 4% as referral percentage</div>
                              </div> 

                              <div id="referal_levels_div" class="row mt-5 ">                                                 
                                @php($ref_set = get_ref_set())
                                @foreach($ref_set as $ref_item)
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <h6> {{ __('Level ').$ref_item->name}} percentage </h6>
                                          <input type="number" step="any" name="{{$ref_item->name}}" value="{{$ref_item->val*100}}" class="form-control" >
                                      </div>
                                  </div>
                                @endforeach                                           
                              </div>
                            </div>
                          </div>

                          <div class="p-5 tab-pane fade" id="mail_settings" role="tabpanel" aria-labelledby="mail_settings-tab">
                            <div class="row "> 
                              <div class="col-sm-12">
                                  <h2 class=""><i class="fas fa-envelope"></i> {{ __('SMTP Settings') }}</h2>
                              </div>
                              <div   class="col-md-6 ">
                                  <div class="card pad_20">
                                      <br>
                                      <div class="form-group">
                                          <h5> {{ __('SMTP Host') }} </h5>
                                          <input type="text" name="m_host" value="{{env('MAIL_HOST')}}" class="form-control" placeholder="Mail Host" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('SMTP Port') }} </h5>
                                          <input type="text" name="m_port" value="{{env('MAIL_PORT')}}" class="form-control" placeholder="Mail Port" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Mail Sender') }} </h5>
                                          <input type="text" name="m_sender" value="{{env('APP_URL')}}" class="form-control" placeholder="Mail Sender" >
                                      </div>
                                  </div>
                              </div> 
                              <div   class="col-md-6 ">
                                  <div class="card pad_20">
                                      <br>
                                      <div class="form-group">
                                          <h5> {{ __('SMTP  Username') }} </h5>
                                          <input type="text" name="m_user" value="{{env('MAIL_USERNAME')}}" class="form-control" placeholder="Mail Username" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('SMTP Password') }} </h5>
                                          <input type="password" name="m_pwd" value="{{env('MAIL_PASSWORD')}}" class="form-control" placeholder="Mail Password" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('SMTP Encryption') }} </h5>
                                          <input type="text" name="m_enc" value="{{env('MAIL_ENCRYPTION')}}" class="form-control" placeholder="Mail Encryption" >
                                      </div>
                                  </div>
                              </div>
                            </div>                                           
                          </div>

                          <div class="p-5 tab-pane fade" id="payment_setting_tab" role="tabpanel" aria-labelledby="payment_setting_tab-tab">
                            <div class="row ">                               
                              <div   class="col-md-6 ">
                                  <!--<div class="card pad_20">
                                      <h3 align="center"><i class="fab fa-cc-paypal fa-3x"></i></h3>
                                      <h2 class="text-center">Paypal Setup</h2>
                                      <hr>
                                      <div class="form-group">
                                          <h5> {{ __('Paypal ID') }} </h5>
                                          <input type="text" name="paypal_ID" value="{{$settings->paypal_ID}}" class="form-control" placeholder="Site Name" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Paypal Secret') }} </h5>
                                          <input type="text" name="paypal_secret" value="{{$settings->paypal_secret}}" class="form-control" placeholder="Site Name" >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Mode') }} </h5>
                                          <select class="form-control" name="paypal_mode" >
                                              <option value="sandbox">Sandbox</option>
                                              <option value="live">Live</option>
                                          </select> 
                                      </div>
                                      <div class="" align="right"> 
                                          <b>On/Off</b><br>             
                                          <label class="switch">
                                            <input id="switch_paypal" type="checkbox" name="switch_paypal"  value="{{env('SWITCH_PAYPAL')}}" @if(env('SWITCH_PAYPAL') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('switch_paypal')"></span>
                                          </label>
                                      </div> --> 
                                      
                                  </div>
                              </div> 
                              <div   class="col-md-6">
                                  <div class="card pad_20" >
                                      <h3 align="center"><i class="fab fa-cc-stripe fa-3x"></i></h3>
                                      <h2 class="text-center">Stripe Setup</h2>
                                      <hr>
                                      <div class="form-group">
                                          <h5> {{ __('Stripe Key') }} </h5>
                                          <input type="text" name="stripe_key" value="{{$settings->stripe_key}}" class="form-control" placeholder="Site Name"  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Stripe Secret') }} </h5>
                                          <input type="text" name="stripe_secret" value="{{$settings->stripe_secret}}" class="form-control" placeholder="Stripe Secrete" >
                                      </div>   
                                      <div class="" align="right"> 
                                          <b>Enable/Disable</b><br>             
                                          <label class="switch">
                                            <input id="switch_stripe" type="checkbox" name="switch_stripe"  value="{{env('SWITCH_STRIPE')}}" @if(env('SWITCH_STRIPE') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('switch_stripe')"></span>
                                          </label>
                                      </div>                                                     
                                  </div>                                                   
                              </div>  
                              
                              <div class="col-md-6">
                                  <div class="card pad_20" >
                                      <h3 align="center"><i class="far fa-building fa-3x"></i></h3>
                                      <h2 class="text-center">Deposit Code</h2>
                                      <hr>
                                    <!--  <div class="form-group">
                                          <h5> {{ __('Bank Name') }} </h5>
                                          <input type="text" name="bank_name" value="{{env('BANK_NAME')}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Account Name') }} </h5>
                                          <input type="text" name="act_name" value="{{env('ACCOUNT_NAME')}}" class="form-control" placeholder="" >
                                      </div>  
                                      <div class="form-group">
                                          <h5> {{ __('Account Number') }} </h5>
                                          <input type="number" name="act_no" value="{{env('ACCOUNT_NUMBER')}}" class="form-control" placeholder="" >
                                      </div>   -->
                                      <div class="form-group">
                                          <h5> {{ __('Deposit Code Support email') }} </h5>
                                          <input type="email" name="dep_email" value="{{env('BANK_DEPOSIT_EMAIL')}}" class="form-control" placeholder="" >
                                      </div>  
                                      <div class="" align="right"> 
                                          <b>Enable/Disable</b><br>             
                                          <label class="switch">
                                            <input id="switch_bank_deposit" type="checkbox" name="switch_bank_deposit"  value="{{env('BANK_DEPOSIT_SWITCH')}}" @if(env('BANK_DEPOSIT_SWITCH') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('switch_bank_deposit')"></span>
                                          </label>
                                      </div>                                                     
                                  </div>                                                   
                              </div>  
                              <div class="col-md-6">
                                  <div class="card pad_20" >
                                      <h3 align="center"><i class="fab fa-bitcoin fa-3x"></i></h3>
                                      <h2 class="text-center">Coinpayment Setup</h2>
                                      <hr>
                                    <!--  <div class="form-group">
                                          <h5> {{ __('COINPAYMENTS_MERCHANT_ID') }} </h5>
                                          <input type="text" name="cp_m_id" value="{{env('COINPAYMENTS_MERCHANT_ID')}}" class="form-control" placeholder=""  >
                                      </div>  
                                      <div class="form-group">
                                          <h5> {{ __('COINPAYMENTS_PUBLIC_KEY') }} </h5>
                                          <input type="text" name="cp_p_key" value="{{env('COINPAYMENTS_PUBLIC_KEY')}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('COINPAYMENTS_PRIVATE_KEY') }} </h5>
                                          <input type="text" name="cp_pr_key" value="{{env('COINPAYMENTS_PRIVATE_KEY')}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('COINPAYMENTS_IPN_SECRET') }} </h5>
                                          <input type="text" name="cp_ipn_secret" value="{{env('COINPAYMENTS_IPN_SECRET')}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('COINPAYMENTS_IPN_URL') }} </h5>
                                          <input type="text" name="cp_ipn_url" value="{{env('COINPAYMENTS_IPN_URL')}}" class="form-control" placeholder=""  >
                                      </div> -->
									  <p> Cyber Admin: Keys must be edited via the .env file for security reasons</p>
                                      
                                      <div class="" align="right"> 
                                          <b>On/Off Bitcoin </b><br>             
                                          <label class="switch">
                                            <input id="switch_BTC" type="checkbox" name="switch_BTC"  value="{{env('SWITCH_BTC')}}" @if(env('SWITCH_BTC') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('switch_BTC')"></span>
                                          </label>
                                      </div> 

                                      <div class="" align="right"> 
                                          <b> On/Off Ethereum </b><br>             
                                          <label class="switch">
                                            <input id="switch_ETH" type="checkbox" name="switch_ETH"  value="{{env('SWITCH_ETH')}}" @if(env('SWITCH_ETH') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('switch_ETH')"></span>
                                          </label>
                                      </div> 

                                  </div>                                                   
                              </div> 

                              <div class="col-md-6">
                                <div class="card pad_20" >
                                    <h3 align="center">
                                      <img align="center" src="/img/coinbase.png" class="img-responsive" style="width: 45%;">
                                    </h3>
                                    <h2 class="text-center">Coinbase Setup</h2>
                                    <hr>
                                  <!--  <div class="form-group">
                                        <h5> {{ __('Coinbase Key') }} </h5>
                                        <input type="text" name="coinbase_key" value="{{ env('COINBASE_API_KEY') }}" class="form-control" placeholder="Coinbase api Key"  >
                                    </div>
                                    <div class="form-group">
                                        <h5> {{ __('Coinbase Webhook Secret') }} </h5>
                                        <input type="text" name="coinbase_seceret" value="{{ env('COINBASE_WEBHOOK_SECRETE') }}" class="form-control" placeholder="Coinbase seceret" >
                                    </div> -->
									
                                    <div class="" align="right"> 
                                        <b>On/Off</b><br>             
                                        <label class="switch">
                                          <input id="coinbase_switch" type="checkbox" name="coinbase_switch"  value="{{ env('COINBASE_SWITCH') }}" @if(env('COINBASE_SWITCH') == 1){{'checked'}}@endif>
                                          <span id="" class="slider round" onclick="checkedOnOff('coinbase_switch')"></span>
                                        </label>
                                    </div>                                                     
                                </div>                                                   
                              </div> 

                              <div class="col-md-6">
                                  <div class="card pad_20" >
                                      <h3 align="center"><img src="https://website-v3-assets.s3.amazonaws.com/assets/img/hero/Paystack-mark-white-twitter.png" height="60px"></img></h3>
                                      <h2 class="text-center">Paystack Setup</h2>
                                      <hr>
                                      <div class="form-group">
                                          <h5> {{ __('Paystack Public Key') }} </h5>
                                          <input type="text" name="paystack_pub_key" value="{{ env('PAYSTACK_PUBLIC_KEY') }}" class="form-control" placeholder="Paystack public key"  >
                                      </div>
                                      <div class="form-group">
                                          <h5> {{ __('Paystack Secret Key') }} </h5>
                                          <input type="text" name="paystack_secret" value="{{ env('PAYSTACK_SECRET_KEY') }}" class="form-control" placeholder="Paystack secrete" >
                                      </div>  
                                      <div class="form-group">
                                          <h5> {{ __('Paystack Merchant Email') }} </h5>
                                          <input type="email" name="paystack_email" value="{{ env('MERCHANT_EMAIL') }}" class="form-control" placeholder="Paystack email" >
                                      </div>
                                      
                                       <div class="form-group">
                                          <h5> {{ __('Paystack Webhook URL') }}</h5>
                                          <input type="text" name="" value="{{ env('APP_URL') }}/paystack/callbck" class="form-control" readonly>
                                      </div>
                                     
                                      <div class="" align="right"> 
                                          <b>On/Off</b><br>             
                                          <label class="switch">
                                            <input id="paystack_switch" type="checkbox" name="paystack_switch"  value="{{ env('PAYSTACK_SWITCH') }}" @if(env('PAYSTACK_SWITCH') == 1){{'checked'}}@endif>
                                            <span id="" class="slider round" onclick="checkedOnOff('paystack_switch')"></span>
                                          </label>
                                      </div>                                                     
                                  </div>                                                   
                              </div> 

                              <div class="col-md-6">
                                <div class="card pad_20" >
                                    <h3 align="center">
                                      <img align="center" src="/img/payeer.png" class="img-responsive" style="width: 45%;">
                                    </h3>
                                    <h2 class="text-center">Payeer Setup</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h5> {{ __('Payeer Merchant ID') }} </h5>
                                        <input type="text" name="payeer_id" value="{{ env('PAYEER_MID') }}" class="form-control" placeholder="Payeer Merchant ID"  >
                                    </div>
                                    <div class="form-group">
                                        <h5> {{ __('Payeer Secret Key') }} </h5>
                                        <input type="text" name="payeer_key" value="{{ env('PAYEER_KEY') }}" class="form-control" placeholder="Payeer Key" >
                                    </div>
                                    <div class="" align="right"> 
                                        <b>On/Off</b><br>             
                                        <label class="switch">
                                          <input id="payeer_switch" type="checkbox" name="payeer_switch"  value="{{ env('PAYEER_SWITCH') }}" @if(env('PAYEER_SWITCH') == 1){{'checked'}}@endif>
                                          <span id="" class="slider round" onclick="checkedOnOff('payeer_switch')"></span>
                                        </label>
                                    </div>                                                     
                                </div>                                                   
                              </div> 

                              <div class="col-md-6">
                                <div class="card pad_20" >
                                    <h3 align="center">
                                      <img align="center" src="http://www.deminetsolution.biz/slides/slide4.jpg" class="img-responsive" style="width: 50%;">
                                    </h3>
                                    <h2 class="text-center">PerfectMoney Setup</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h5> {{ __('PM Account ID') }} </h5>
                                        <input type="text" name="pm_id" value="{{ env('PM_ACCOUNT') }}" class="form-control" placeholder="Perfect Account ID"  >
                                    </div>
                                    <div class="form-group">
                                        <h5> {{ __('Your Company Name') }} </h5>
                                        <input type="text" name="pm_name" value="{{ env('PM_COMPANY') }}" class="form-control" placeholder="Your Company Title" >
                                    </div>
                                    <div class="" align="right"> 
                                        <b>On/Off</b><br>             
                                        <label class="switch">
                                          <input id="pm_switch" type="checkbox" name="pm_switch"  value="{{ env('PM_SWITCH') }}" @if(env('PM_SWITCH') == 1){{'checked'}}@endif>
                                          <span class="slider round" onclick="checkedOnOff('pm_switch')"></span>
                                        </label>
                                    </div>                                                     
                                </div>                                                   
                              </div> 

                            </div>

                          </div>
                        </div>

                        <div class="row margin_top50 mb-5"> 
                          <div   class="col-md-12">
                            <button class="btn btn-info float-right"  onclick="load_post_ajax('/admin/update/site/settings', 'settings_form', 'admin_settings_form' )" > {{ __('Save Changes') }} </button>
                          </div>                                     
                        </div>

                      </form>                      
                    </div>
                  </div>

                </div>

            </div>
@endSection