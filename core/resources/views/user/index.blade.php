@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
		<div class="main-panel">
			<div class="content">
			    @php($breadcome = 'Dashboard')
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
					
					

					
					
					
					
					</div>

					
					<div id="prnt"></div>
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">{{ __('Investment Statistics') }}</div>
										<div class="card-tools">											
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="statisticsChart2"></canvas>
									</div>
									<div id="myChartLegend2"></div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<div class="card-title">{{ __('Withdrawal Stats') }} </div>
									<div class="card-category">
									    <?php
									        $total_wd = 0;
									        foreach($wd as $w)
									        {
    											$total_wd += $w->amount;
									        }
									    ?>
										<h1>{{$settings->currency.' '. $total_wd}}</h1>
									</div>
								</div>
								
								<div class="pb-0 card-body">									
									<div class="pull-in">
										<canvas id="wd_stats"></canvas>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="pb-0 card-body">
									<div class="px-2 pb-2 text-center pb-md-0">
										<div id="circles-logs"></div>
										<h6 class="mt-3 mb-0 fw-bold">{{ __('Action History') }}</h6>
										<br>
									</div>									
								</div>
							</div>
						</div>
					</div>
					
					<!--	Container	-->
					<div class="custom-wrapper">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{ __('Available Packages') }} </div>
									</div>
									<div class="pb-0 card-body">
										@include('user.inc.packages')
									</div>
								</div>
							</div>
						</div>

						<div class="row row-card-no-pd">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-head-row card-tools-still-right">
											<h4 class="card-title">{{ __('User Activities') }}</h4>
											<div class="card-tools">
												<button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
												<button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
												<button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
											</div>
										</div>
										<p class="card-category">{{ __('All actions by you on tradepander.') }}</p>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
												<div class="card">												
													<div class="card-body">
														<div class="table-responsive">
															<table id="basic-datatables" class="table display table-striped table-hover" >
																<thead>
																	<tr>
																		<th>{{ __('Actions') }}</th>
																		<th>{{ __('Date') }}</th>
																	</tr>
																</thead>
																<tfoot>
																	<tr>
																		<th>{{ __('Actions') }}</th>
																		<th>{{ __('Date') }}</th>
																	</tr>
																</tfoot>
																<tbody>																
																	@foreach( $logs as $log)
																		<tr>
																			<td>
																				{{ $log->action }}
																			</td>
																			<td>{{ $log->created_at }}</td>
																		</tr>
																	@endforeach																
																</tbody>
															</table>														
														</div>
														
													</div>
												</div>
											</div>
											
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
			