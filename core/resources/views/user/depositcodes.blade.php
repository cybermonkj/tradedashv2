@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
		<div class="main-panel">
			<div class="content">
			    @php($breadcome = 'Buy Deposit Codes')
				@include('user.atlantis.main_bar')
				<div class="page-inner mt--5">

					@include('user.atlantis.overview')

										<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://dash.tradepander.com/{username}/trade" rel="noopener" target="_blank"><span class="blue-text">Our Traders are currently watching</span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "proName": "FOREXCOM:SPXUSD",
      "title": "S&P 500"
    },
    {
      "proName": "FOREXCOM:NSXUSD",
      "title": "Nasdaq 100"
    },
    {
      "proName": "FX_IDC:EURUSD",
      "title": "EUR/USD"
    },
    {
      "proName": "BITSTAMP:BTCUSD",
      "title": "BTC/USD"
    },
    {
      "proName": "BITSTAMP:ETHUSD",
      "title": "ETH/USD"
    },
    {
      "description": "Agile",
      "proName": "NYSE:A"
    },
    {
      "description": "Microsoft",
      "proName": "NASDAQ:MSFT"
    },
    {
      "description": "Apple",
      "proName": "NASDAQ:AAPL"
    },
    {
      "description": "Paypal",
      "proName": "NASDAQ:PYPL"
    },
    {
      "description": "SAMSUNG",
      "proName": "KRX:005930"
    },
    {
      "description": "LG",
      "proName": "KRX:066570"
    },
    {
      "description": "TESLA",
      "proName": "NASDAQ:TSLA"
    },
    {
      "description": "FORD",
      "proName": "NYSE:F"
    },
    {
      "description": "VOLKSWAGEN",
      "proName": "SWB:VOW3"
    }
  ],
  "showSymbolLogo": true,
  "colorTheme": "light",
  "isTransparent": false,
  "displayMode": "adaptive",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->

<h1></h1>
<p>Tradepander Deposit Code</p>

<div class="card">
	<div class="card-body">
<p>what is TDC</p>
<p></p>
<p>Tradepander Deposit Code otherwise know as TDC,  is a unique code that is used to credit your tradepander wallet with the equivalent purchased.</p>
<p></p>
<p>All you need to get started is, purchase a deposit code that suits your investment choice and your tradepander account would automatically be credited with the worth purchased.</p>
<p></p>
<p>Check our investment plans below and contact any of our verified code vendors to purchase your code.</p>
<p></p>
<p>Attention!!! Payment to any person/vendor not listed below is at your own risk, and Tradepander would not bear any losses!!</p>
<p></p>
<p>Purchased a Code already?</p>
<button class="btn btn-primary"><span class="btn-label"><i class="fas fa-shopping-bag"></i></span> I already have a deposit code</button>
<p> </p>

TDC Verified Vendors
If the vendor you contacted is not responsive, kindly check others on the list

</div>
</div>

<div class="card" style="width: 20rem;">
	<div class="card-body">
		<h4 class="card-title">Cartel Media</h4>
		<a href="https://wa.link/jw5tgp" class="btn btn-primary">Contact</a>
	</div>
</div>
<div class="card" style="width: 20rem;">
	<div class="card-body">
		<h4 class="card-title">GG Africa</h4>
		<a href="https://wa.me/23408112039498?text=Hello+GG+Africa%2C+I+want+to+buy+tradepander+deposit+code" class="btn btn-primary">Contact</a>
	</div>
</div>
    <div class="card" style="width: 20rem;">
        <div class="card-body">
            <h4 class="card-title">SIR Godwin</h4>
            <a href="https://wa.link/5qky4t" class="btn btn-primary">Contact</a>
        </div>
    </div>
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h4 class="card-title">Chidex Media</h4>
                <a href="http://mywa.link/5xowx0sv" class="btn btn-primary">Contact</a>
            </div>
        </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title">Chidex Media</h4>
                    <a href="http://mywa.link/5xowx0sv" class="btn btn-primary">Contact</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title">Xpress Media</h4>
                    <a href="https://wa.link/zkoc40" class="btn btn-primary">Contact</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title">Spy TV</h4>
                    <a href="https://api.whatsapp.com/send?phone=2349040026809&text=Hello%20Spytvmedia,%20I%20want%20to%20buy%20tradepander%20Coupon%20Code" class="btn btn-primary">Contact</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title">Elmeme TV</h4>
                    <a href="https://wa.link/5kmsdz" class="btn btn-primary">Contact</a>
                </div>
            </div>

</div>




@include('user.inc.confirm_inv')

@endSection
