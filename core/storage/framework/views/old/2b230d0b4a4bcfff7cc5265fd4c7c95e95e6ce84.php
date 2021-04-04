<style>
	#card__header {
		display: flex;
		align-items: center;
		justify-content: space-between;

		flex-direction: row;
	}
	.tool-list {
		display: flex;
		align-items: center;
		padding: 1rem 0
	}

	.tool-list__item {
		display: flex;
		justify-content: center;
		align-items: center;
		
		padding: .5rem;
		width: 1.6rem;
		height: 1.8rem;;
		border: none;
		outline: none;
		border-radius: 6px;
		background: #fff;
		box-shadow: 0 4px 8px rgba(10, 10, 10, 0.2);
	}

	.tool-list__item:not(:last-child) {
		margin-right: 1rem;
	}

	.tool-list__item i {
		color: #100ba3 !important; 
		font-size: 1rem !important;
	}

	.tool-list__item:hover {
		background: #F5F5F5;
	}

	#card__packages {
		padding: 0 !important;
		margin: 0 !important;
		background: transparent !important;	
		box-shadow: 0 0 0 rgba(10, 10, 10, 0.2) !important;
	}

	@media (min-width: 768px) {
		#card__packages {
			padding: 1rem;
			margin: 0 !important;
			background: #fff;	
		}

		.custom-wrapper {
			padding: 2rem !important;
		}
	}
</style>

<?php echo $__env->make('user.inc.fetch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
		<div class="main-panel">
			<div class="content">
			    <?php ($breadcome = 'Dashboard'); ?>
				<?php echo $__env->make('user.atlantis.main_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="page-inner mt--5">

					<?php echo $__env->make('user.atlantis.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
					<div class="row" style="padding: 2rem">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title"><?php echo e(__('Investment Statistics')); ?></div>
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
									<div class="card-title"><?php echo e(__('Withdrawal Stats')); ?> </div>
									<div class="card-category">
									    <?php
									        $total_wd = 0;
									        foreach($wd as $w)
									        {
    											$total_wd += $w->amount;
									        }
									    ?>
										<h1><?php echo e($settings->currency.' '. $total_wd); ?></h1>
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
										<h6 class="mt-3 mb-0 fw-bold"><?php echo e(__('Action History')); ?></h6>
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
								<div class="p-0 card" id="card__packages">
									<div class="card-header">
										<div class="card-title"><?php echo e(__('Available Packages')); ?> </div>
									</div>
									<div class="pb-0 card-body">
										<?php echo $__env->make('user.inc.packages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									</div>
								</div>
							</div>
						</div>

						<div class="mt-2 row row-card-no-pd">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-head-row card-tools-still-right" id="card__header">
											<h4 class="card-title"><?php echo e(__('User Activities')); ?></h4>
											

											<ul class="tool-list">
												<button class="tool-list__item"><i class="fa fa-angle-down"></i></button>
												<button class="tool-list__item"><i class="fa fa-sync-alt"></i></button>
												<button class="tool-list__item"><i class="fa fa-times"></i></button>
											</ul>
										</div>
										<p class="card-category"><?php echo e(__('All actions by you on tradepander.')); ?></p>
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
																		<th><?php echo e(__('Actions')); ?></th>
																		<th><?php echo e(__('Date')); ?></th>
																	</tr>
																</thead>
																<tfoot>
																	<tr>
																		<th><?php echo e(__('Actions')); ?></th>
																		<th><?php echo e(__('Date')); ?></th>
																	</tr>
																</tfoot>
																<tbody>																
																	<?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<tr>
																			<td>
																				<?php echo e($log->action); ?>

																			</td>
																			<td><?php echo e($log->created_at); ?></td>
																		</tr>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>																
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

			 <?php echo $__env->make('user.inc.confirm_inv', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
			
<?php echo $__env->make('layouts.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/user/index.blade.php ENDPATH**/ ?>