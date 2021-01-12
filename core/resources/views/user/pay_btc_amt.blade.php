@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
    <div class="main-panel">
        <div class="content">
            @php($breadcome = 'CoinPayment Gateway')
            @include('user.atlantis.main_bar')
            <div class="page-inner mt--5">                   
                <div id="prnt"></div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">
                                        @if ($coin == 'BTC')
                                        {{ __('Deposit Using Bitcoin') }}
                                        @else
                                        {{ __('Deposit Using Ethereum') }}
                                        @endif
                                        </div>
                                    <div class="card-tools">                                            
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">                                      
                                    <div class="col-md-7">
                                        <div class="panel-body">

                                            <form class="form-horizontal" method="POST" role="form" action="{!! URL::route('btc.paybtcamt') !!}" >
                                                @csrf
                                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                                    <label for="amount" class="col-md-4 control-label">{{ __('Enter Amount') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><b>{{__('USD')}}</b></span>
                                                            </div>
                                                            <input id="amount" type="hidden" class="form-control" value="{{ $coin }}" name="coin" required >
                                                            <input id="amount" type="number" class="form-control" name="amount" required autofocus>                    
                                                        </div>
                                                        @if (Session::has('err'))
                                                            <span class="help-block text-danger">
                                                                <strong>{{ Session::get('err') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Pay Now') }}
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-md-5" align="center"><br>
                                    @if ($coin == 'BTC')
                                        <i class="fab fa-bitcoin fa-4x text-info"></i>
                                     @else
                                     <i class="fab fa-ethereum fa-4x text-info"></i>
                                     @endif
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>

        @include('user.inc.confirm_inv')

@endSection
            