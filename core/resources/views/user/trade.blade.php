@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
            
<div class="main-panel">
    <div class="content">
        @php($breadcome = 'Trade (Live)')
        @include('user.atlantis.main_bar')
        <div class="page-inner mt--5">
            @include('user.atlantis.overview')
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('This Weeks Trade') }}</div>                                       
                            </div>
                        </div>
                        <div class="card-body">  
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
                                <div id="tradingview_86b2f"></div>
                                <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/AAPL/" rel="noopener" target="_blank"><span class="blue-text">Apple</span></a> by TradingView</div>
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                new TradingView.MediumWidget(
                                {
                                "symbols": [
                                [
                                    "Apple",
                                    "AAPL"
                                ],
                                [
                                    "Google",
                                    "GOOGL"
                                ],
                                [
                                    "Microsoft",
                                    "MSFT"
                                ],
                                [
                                    "Tesla",
                                    "NASDAQ:TSLA|12M"
                                ],
                                [
                                    "BTC/USD",
                                    "BITBAY:BTCUSD|ALL"
                                ],
                                [
                                    "ETH/USD",
                                    "BITFINEX:ETHUSD/ |12M"
                                ],
                                [
                                    "USD/NAIRA",
                                    "FX_IDC:USDNGN|ALL"
                                ],
                                [
                                    "JUMIA",
                                    "NYSE:JMIA|12M"
                                ],
                                [
                                    "Dangote Cement",
                                    "NSENG:DANGCEM|ALL"
                                ]
                                ],
                                "chartOnly": false,
                                "width": 1000,
                                "height": 400,
                                "locale": "en",
                                "colorTheme": "light",
                                "gridLineColor": "#F0F3FA",
                                "trendLineColor": "rgba(0, 0, 255, 1)",
                                "fontColor": "#787B86",
                                "underLineColor": "rgba(73, 133, 231, 1)",
                                "isTransparent": false,
                                "autosize": false,
                                "container_id": "tradingview_86b2f"
                            }
                                );
                                </script>
                            </div>
                            <!-- TradingView Widget END -->


                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                                    <!-- TradingView Widget BEGIN -->
                                            <div class="tradingview-widget-container">
                                                <div class="tradingview-widget-container__widget"></div>
                                                <div class="tradingview-widget-copyright"><a href="#" rel="noopener" target="_blank"><span class="blue-text">TSLA Profile</span></a></div>
                                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-profile.js" async>
                                                {
                                                "symbol": "NASDAQ:TSLA",
                                                "width": "480",
                                                "height": "650",
                                                "colorTheme": "light",
                                                "isTransparent": false,
                                                "locale": "en"
                                            }
                                                </script>
                                            </div>
                                                        <!-- TradingView Widget END -->
                    
                            </div>
                            <div margin="20" class="col-xs-6">
                                                <!-- TradingView Widget BEGIN -->
                                            <div class="tradingview-widget-container">
                                                <div class="tradingview-widget-container__widget"></div>
                                                <div class="tradingview-widget-copyright"><a href="#" rel="noopener" target="_blank"><span class="blue-text">TSLA Fundamental Data</span></a> by TradingView</div>
                                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-financials.js" async>
                                                {
                                                "symbol": "NASDAQ:TSLA",
                                                "colorTheme": "light",
                                                "isTransparent": false,
                                                "largeChartUrl": "",
                                                "displayMode": "adaptive",
                                                "width": 480,
                                                "height": 830,
                                                "locale": "en"
                                            }
                                                </script>
                                            </div>
                                            <!-- TradingView Widget END -->
                            </div>
                        </div>
                    </div>




                    
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('Other Watches') }}</div>                                       
                            </div>
                        </div>
                        <div class="card-body "> 


                        </div>
                    </div>
                </div>
            </div>
</div>




@endSection