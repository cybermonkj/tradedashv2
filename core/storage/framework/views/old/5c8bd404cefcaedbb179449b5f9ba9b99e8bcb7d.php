<?php echo $__env->make('user.inc.fetch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
            
<div class="main-panel">
    <div class="content">
        <?php ($breadcome = 'Trade (Live)'); ?>
        <?php echo $__env->make('user.atlantis.main_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-inner mt--5">
            <?php echo $__env->make('user.atlantis.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title"><?php echo e(__('This Weeks Trade')); ?></div>                                       
                            </div>
                        </div>
                        <div class="card-body">  
                                

                    <!-- end of chart -->



                                                <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div id="tradingview_86b2f"></div>
                                <div class="tradingview-widget-copyright"><a href="#" rel="noopener" target="_blank"><span class="blue-text"></span></a> Updates in Real time</div>
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
                                "width": "1000",
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
                                                "width": "100%",
                                                "height": "650",
                                                "colorTheme": "light",
                                                "isTransparent": false,
                                                "locale": "en"
                                            }
                                                </script>
                                            </div> 
                                        </div>
                                            <div  class="col-xs-6" >
                                                <!-- TradingView Widget BEGIN -->
                                                    <div class="tradingview-widget-container">
                                                        <div class="tradingview-widget-container__widget"></div>
                                                        <div class="tradingview-widget-copyright"><a href="#" rel="noopener" target="_blank"><span class="blue-text">Financial Markets</span></a></div>
                                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                                                        {
                                                        "colorTheme": "light",
                                                        "dateRange": "12M",
                                                        "showChart": true,
                                                        "locale": "en",
                                                        "largeChartUrl": "",
                                                        "isTransparent": false,
                                                        "showSymbolLogo": true,
                                                        "width": "auto",
                                                        "height": "660",
                                                        "plotLineColorGrowing": "rgba(0, 0, 255, 1)",
                                                        "plotLineColorFalling": "rgba(73, 133, 231, 1)",
                                                        "gridLineColor": "rgba(240, 243, 250, 1)",
                                                        "scaleFontColor": "rgba(120, 123, 134, 1)",
                                                        "belowLineFillColorGrowing": "rgba(33, 150, 243, 0.12)",
                                                        "belowLineFillColorFalling": "rgba(33, 150, 243, 0.12)",
                                                        "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
                                                        "tabs": [
                                                        {
                                                            "title": "Indices",
                                                            "symbols": [
                                                            {
                                                                "s": "FOREXCOM:SPXUSD",
                                                                "d": "S&P 500"
                                                            },
                                                            {
                                                                "s": "FOREXCOM:NSXUSD",
                                                                "d": "Nasdaq 100"
                                                            },
                                                            {
                                                                "s": "FOREXCOM:DJI",
                                                                "d": "Dow 30"
                                                            },
                                                            {
                                                                "s": "INDEX:NKY",
                                                                "d": "Nikkei 225"
                                                            },
                                                            {
                                                                "s": "INDEX:DEU30",
                                                                "d": "DAX Index"
                                                            },
                                                            {
                                                                "s": "FOREXCOM:UKXGBP",
                                                                "d": "FTSE 100"
                                                            }
                                                            ],
                                                            "originalTitle": "Indices"
                                                        },
                                                        {
                                                            "title": "Commodities",
                                                            "symbols": [
                                                            {
                                                                "s": "CME_MINI:ES1!",
                                                                "d": "S&P 500"
                                                            },
                                                            {
                                                                "s": "CME:6E1!",
                                                                "d": "Euro"
                                                            },
                                                            {
                                                                "s": "COMEX:GC1!",
                                                                "d": "Gold"
                                                            },
                                                            {
                                                                "s": "NYMEX:CL1!",
                                                                "d": "Crude Oil"
                                                            },
                                                            {
                                                                "s": "NYMEX:NG1!",
                                                                "d": "Natural Gas"
                                                            },
                                                            {
                                                                "s": "CBOT:ZC1!",
                                                                "d": "Corn"
                                                            }
                                                            ],
                                                            "originalTitle": "Commodities"
                                                        },
                                                        {
                                                            "title": "Bonds",
                                                            "symbols": [
                                                            {
                                                                "s": "CME:GE1!",
                                                                "d": "Eurodollar"
                                                            },
                                                            {
                                                                "s": "CBOT:ZB1!",
                                                                "d": "T-Bond"
                                                            },
                                                            {
                                                                "s": "CBOT:UB1!",
                                                                "d": "Ultra T-Bond"
                                                            },
                                                            {
                                                                "s": "EUREX:FGBL1!",
                                                                "d": "Euro Bund"
                                                            },
                                                            {
                                                                "s": "EUREX:FBTP1!",
                                                                "d": "Euro BTP"
                                                            },
                                                            {
                                                                "s": "EUREX:FGBM1!",
                                                                "d": "Euro BOBL"
                                                            }
                                                            ],
                                                            "originalTitle": "Bonds"
                                                        },
                                                        {
                                                            "title": "Forex",
                                                            "symbols": [
                                                            {
                                                                "s": "FX:EURUSD"
                                                            },
                                                            {
                                                                "s": "FX:GBPUSD"
                                                            },
                                                            {
                                                                "s": "FX:AUDUSD"
                                                            },
                                                            {
                                                                "s": "FX:USDCAD"
                                                            },
                                                            {
                                                                "s": "USD/FX_IDC:USDNGN",
                                                                "d": "USD/NGN"
                                                            },
                                                            {
                                                                "s": "BTC/FX_IDC:NGNEUR",
                                                                "d": "NGN/EUR"
                                                            }
                                                            ],
                                                            "originalTitle": "Forex"
                                                        }
                                                        ]
                                                    }
                                                        </script>
                                                    </div>
                                                    <!-- TradingView Widget END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card text-center">
                                <div class="card-header">
                                    Want a full experience
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Trade watcher</h5>
                                    <p class="card-text">Trade watcher is still on beta and Might be 10-15 mins late, and you might experience scattered appearances on Mobile.</p>
                                    <a href="#" class="btn btn-primary">Acknowledge</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/user/trade.blade.php ENDPATH**/ ?>