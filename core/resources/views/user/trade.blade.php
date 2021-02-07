@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
            
<div class="main-panel">
    <div class="content">
        @php($breadcome = 'What we are currently Trading (Live)')
        @include('user.atlantis.main_bar')
        <div class="page-inner mt--5">
            @include('user.atlantis.overview')
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                {{-- <style type="text/css">
                                    /* .toast {display: none;}
                                   */
                                    /* Smartphone Portrait and Landscape */
                                    @media only screen
                                      and (min-device-width : 320px)
                                      and (max-device-width : 480px){ 
                                        .mobileShow {display: inline;}
                                    }

                                    .mobileHide { display: inline; }

                                    /* Smartphone Portrait and Landscape */
                                    @media only screen
                                        and (min-device-width : 320px)
                                        and (max-device-width : 480px){
                                        .mobileHide { display: none;}
                                    }
                                  </style>
 
<!-- MT5 Trader start -->

                                <div class="mobileHide" style="margin-left:20" width="60%" scrolling="no">
                                        <iframe src="https://trade.mql5.com/trade" name="Trader" title="Stock/Forex Trader" frameborder="0" style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                                            </div>
                                        </div>
                                    </div> 

                    <script>
                    if(window.innerWidth <= 800 && window.innerHeight <= 600) {
                      document.querySelector('.mobileHide').style.display = "none"
                   }
                    </script>

                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                            <img src="logo.svg" class="rounded mr-2" alt="...">
                            <strong class="mr-auto">Disabled on Mobile</strong>
                            <small>1 mins ago</small>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="toast-body">
                            You cannot use the Trading experience on Mobile, Please get a bigger display to enJoy live trade
                            </div>
                        </div>

 --}}

<!-- end of chart -->
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
    <div class="tradingview-widget-container__widget"></div>
    <div class="tradingview-widget-copyright"><a href="#/" rel="noopener" target="_blank"><span class="blue-text">TSLA Profile</span></a> Featured Trade: Tesla</div>
    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-profile.js" async>
    {
    "symbol": "NASDAQ:TSLA",
    "width": "100%",
    "height": "100%",
    "colorTheme": "light",
    "isTransparent": false,
    "locale": "en"
  }
    </script>
  </div>
  <!-- TradingView Widget END -->




@endSection