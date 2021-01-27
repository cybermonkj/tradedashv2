<?php $__env->startSection('content'); ?>
	<div class="main-panel">
		<div class="content">
			<?php echo $__env->make('admin.atlantis.main_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="page-inner mt--5">
				<?php echo $__env->make('admin.atlantis.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="container">
					<div class="row align-items-start">
						<div class="col-12 col-sm-12">
							<h1 class="text-uppercase display-5">Coupon Codes</h1>
						</div>

						<div class="p-4 shadow card" style="width: 100% !important">
							<?php echo $__env->make('admin.components.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>

						<div class="px-4 my-4">
							<div class="row">
								<a style="color: #fff !important" class="btn btn-success btn-lg text-capitalize" href="<?php echo e(route('export.codes')); ?>">Export Coupons</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/admin/coupon_code.blade.php ENDPATH**/ ?>