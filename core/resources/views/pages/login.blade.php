<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="panel-body" style="">
            <form method="POST" action="/">                        
                <input id="csrf" type="hidden"  name="_token" value="{{ csrf_token() }}" >
                <div class="form-group row">
                    <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="input-group">
                        <input id="" type="hidden" name="_token" value="{{csrf_token()}}" class="form-control">
                        <div class="input-group-prepend bg_ash">
                            <span class="input-group-text"><i class="fa fa-envelope "></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                        {{-- @error('email')
                            <span class="invalid-feedback text-danger" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror --}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class=" col-form-label text-md-right">{{ __('Admin Password') }}</label>

                    <div class="input-group">
                        <div class="input-group-prepend bg_ash">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback text-danger" role="alert" >
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>                               
                    </div>                            
                </div>
            </form>
        </div>
    </main>
</body>
</html>