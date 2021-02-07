@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
            
<div class="main-panel">
    <div class="content">
        @php($breadcome = 'Live Trader (Beta)')
        @include('user.atlantis.main_bar')
        <div class="page-inner mt--5">
            @include('user.atlantis.overview')
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
 
<!-- MT5 Trader start -->

                 < <div class="v-tour-object" style="margin-left:30" width="100%" scrolling="no">
                    <iframe src="https://trade.mql5.com/trade" name="Trader" title="Stock/Forex Trader" frameborder="0" style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                        </div>
                    </div>
                </div> 

                <script>
                    if(window.innerWidth <= 800 && window.innerHeight <= 600) {
                      document.querySelector('.v-tour-object').style.display = "none"
                   }
                   </script>

<!-- end of chart -->





@endSection