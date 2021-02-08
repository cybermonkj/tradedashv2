@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')


<div class="main-panel">
    <div class="content">
        {{-- @php($breadcome = 'Crypto Exhange wallet ()')
        @include('user.atlantis.main_bar')
        {{-- <div class="page-inner mt--5">
            @include('user.atlantis.overview')
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('Crypto Exhange wallet') }}</div>                                       
                            </div>
                        </div> --}}
                                <div class="card-body">  
                                        <div class="mobileHide" style="margin-left:20" width="60%" scrolling="no">
                                            <iframe src="https://dash.tradepander.com/exchange/" name="Exchange" title="Exchange" frameborder="0" style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                                                </div>
                                            </div>
                                        </div> 

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


@endSection
            