@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
            
<!-- MT5 Trader start -->
            < <div class="col p-4" style="margin-left:-30px">
                    <iframe src="https://trade.mql5.com/trade" name="WebTrader" title="Stock/Forex Trader" frameborder="0" style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                        </div>
                    </div>
                </div> 
<!-- end of chart -->



@endSection