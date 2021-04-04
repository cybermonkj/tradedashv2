<div class="row mt--2">
	<div class="col-md-6">
		<div class="card full-height">
			<div class="card-body">
				<div class="card-title">Statistics Summary</div>
				<div class="card-category">Tradepander Statistics</div>
				<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
					<div class="px-2 pb-2 pb-md-0 text-center">
						<div id="circles-1"></div>
						<h6 class="fw-bold mt-3 mb-0">Users</h6>
            <span>Inactive: <?php echo e(count($users->where('status', '!=', '1'))); ?></span>
					</div>
					<div class="px-2 pb-2 pb-md-0 text-center">
            <?php
                $inv = App\investment::orderby('id', 'desc')->get();
                $cap = 0;
                $cap2 = 0;
            ?>                        
						<div id="circles-2"></div>
						<h6 class="fw-bold mt-3 mb-0">Investments</h6>
            <span>Inactive: <?php echo e(count($inv->where('status', '!=', 'Active'))); ?></span>
					</div>
					<div class="px-2 pb-2 pb-md-0 text-center">
            <?php
                $deposits = App\deposits::orderby('id', 'desc')->get();
                $dep = 0;
                $dep2 = 0;
            ?>           
						<div id="circles-3"></div>
						<h6 class="fw-bold mt-3 mb-0">Total Deposits</h6>
            			<span>Inactive: <?php echo e(count($deposits->where('status', '!=', '1'))); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/admin/atlantis/overview.blade.php ENDPATH**/ ?>