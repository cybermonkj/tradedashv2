@extends('inc.auth_layout')
@section('content')
<body>
    <div style="">
        <img src="/img/inv_bg2.jpg" class="fixedOverlayIMG">         
        <div class="fixedOeverlayBG"></div>
        <div class="">
            <div class="row login_row_cont">
                <div class="col-md-6 position_relative" >
                    <div class="logo_cont" align="center">
                        <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                        <h1>{{$settings->site_title}}</h1> 
                        <p>                                                       
                            <h4>{{$settings->site_descr}}</h4>
                        </p>
                    </div>                    
                </div>
                <div class="col-md-6 bg_white">
                    <div class="login_fixed_panel">
                        <div class="row">
                            <div class="col-md-12" >
                                <div>                        
                                    <div class="">
                                        <div class="">
                                            <div align="center">
                                                <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                                                <br>
                                                <h3 class="colhd"><i class="fa fa-user"></i> Create an Account</h3>
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="reg_form_scroll scroll">
                                            <form method="POST" action="{{ route('register') }}">                                                
                                                <input id="csrf" type="hidden"  name="_token" value="{{ csrf_token() }}" >
                                                <div class="form-group row">                                                    
                                                    <div class="col-sm-6">
                                                        <input id="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror regTxtBox" name="Fname" value="{{ old('Fname') }}" required autocomplete="Fname" autofocus placeholder="First Name">

                                                        @error('Fname')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <input id="Lname" type="text" class="form-control @error('Lname') is-invalid @enderror regTxtBox" name="Lname" value="{{ old('Lname') }}" required autocomplete="Lname" autofocus placeholder="Last Name">

                                                        @error('Lname')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group row"> 
                                                    
                                                    <div class="col-sm-12">
                                                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror regTxtBox" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert alert-danger">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-sm-12">
                                                       <input id="username" type="username" class="form-control @error('username') is-invalid @enderror regTxtBox" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username">

                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror regTxtBox" name="password" required autocomplete="new-password" placeholder="Password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input id="password-confirm" type="password" class="form-control regTxtBox" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" >
                                                    </div>

                                                </div>


                                                <?php
                                                    $usn = App\User::where('username', Session::get('ref'))->get();
                                                ?>

                                                <div class="row">
                                                    <div class="">
                                                        <input id="ref" type="hidden" class="form-control" name="ref" value="@if(count($usn) > 0){{Session::get('ref')}}@endif" >
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                        <br><br>
                                                        @if($settings->user_reg == 1)
                                                            <button type="submit" class="collc btn btn-primary">
                                                                {{ __('Register') }}
                                                            </button>
                                                        @else
                                                            <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Registration disabled by admin.</div>
                                                        @endif
                                                        <br><br>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                       <p>
                                                          <strong>Already have an account? <a href="/login">Login</a></strong>
                                                       </p>                            
                                                    </div>
                                                </div>                                      
                                        
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
@endsection
