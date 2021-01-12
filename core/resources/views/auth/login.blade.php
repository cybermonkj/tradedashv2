@extends('inc.auth_layout')
@section('content')
<body>
    <div style="">
        <img src="/img/inv_bg2.jpg" class="fixedOverlayIMG">         
        <div class="fixedOeverlayBG"></div>
        <div class="">
            <div class="row login_row_cont">
                <div class="col-md-6 position_relative">
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
                                <div style="">                        
                                    <div class="">
                                        <div class="">
                                            <div align="center">
                                                <img src="/img/{{$settings->site_logo}}" alt="{{$settings->site_title}}" class="login_logo">
                                                <br>
                                                <h3 class="colhd"><i class="fa fa-key"></i>{{ __('User Login') }}</h3>
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="form_cont">
                                            <form method="POST" action="{{ route('session_sa.upload_u2s') }}" class=""> 
                                                @if(Session::has('err_msg'))
                                                    <div class="alert alert-danger">
                                                        {{Session::get('err_msg')}}
                                                    </div>
                                                     {{Session::forget('err_msg')}}
                                                @endif

                                                @if(Session::has('regMsg'))
                                                    <div class="alert alert-success" >
                                                        {{Session::get('regMsg')}}
                                                    </div>
                                                     {{Session::forget('regMsg')}}
                                                @endif                                                
                                                
                                                <div class="form-group row" > 
                                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                                        <input id="email" type="email" class=" @error('email') is-invalid @enderror regTxtBox" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                  
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password">{{ __('Password') }}</label>
                                                        <input id="password" type="password" class=" @error('password') is-invalid @enderror regTxtBox" name="password" required autocomplete="current-password" placeholder="Password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert alert-danger" >
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    
                                                </div>

                                                <div class="row">                                                    
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    &nbsp;
                                                    <label class="" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                                                                            
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                        <button type="submit" class="collc btn btn-primary">
                                                            {{ __('Login') }}
                                                        </button>                               
                                                    </div>
                                                    <div class="" align="center" >                                
                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="" align="center">
                                                       <p>
                                                           <strong>{{ __("Don't have an account?") }} <a href="/register">{{ __('Register') }}</a></strong>
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
