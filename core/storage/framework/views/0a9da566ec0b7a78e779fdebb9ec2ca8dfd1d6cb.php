<style>
    .flex-section {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center;

    }
</style>


<?php $__env->startSection('content'); ?>
	<div class="main-panel">
		<div class="content">
			<?php echo $__env->make('admin.atlantis.main_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="page-inner mt--5">
				<?php echo $__env->make('admin.atlantis.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="container mt-4" style="overflow-x: auto !important;">
                  
                    <div class="p-3 mb-2 bg-light text-dark flex-section flex-sm-column">
                        <p class="text-muted text-justify" style="font-size: 1.4rem;">Manually Update User Wallet</p>
                        <button class="btn btn-success" data-toggle="modal" data-target="#updateModal">Update</button>
                    </div>

                    <?php if(Session::has('msgTest')): ?>
                        <div class="alert alert-info"><?php echo e(Session::get('msgTest')); ?></div>
                    <?php endif; ?>
                    


                    <!--    Modals Start   -->
                        <div class="modal fade" id="correctModal" tabindex="-1" aria-labelledby="correctLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="correctlLabel">Correct Balance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="userid">Actual Balance</label>
                                            <input type="number" name="wallet" id="wallet" class="form-control" aria-describedby="walletHelp" required>
                                            <small id="walletHelp" class="form-text text-muted">Enter the user's actaul balance to update his wallet.</small>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-send2">Update</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>


                        <!--    Second  -->

                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="updateLabel">Change Wallet Balance</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form method="post" action="/admin/change/balance" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" aria-describedby="usernameHelp" required>
                                            <small id="usernameHelp" class="form-text text-muted">Enter the user's username.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="wallet">Actual Balance</label>
                                            <input type="number" name="wallet" id="wallet" class="form-control" aria-describedby="walletHelp" required>
                                            <small id="walletHelp" class="form-text text-muted">Enter the user's actaul balance to update his wallet.</small>
                                        </div>
                                      </div>

                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary btn-send">Change</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>

                    <!--    Modals End  -->
                    
					<div>
                        <table class="bg-white table table-hover table-bordered mt-4">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Wallet</th>
                                <th scope="col">Withdrawable Amt</th>
                                <th scope="col">Last Withdrawable</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Invested</th>
                                <th scope="col">End Date</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bundle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($item->id); ?></th>
                                        <td><?php echo e($item->firstname ." ". $item->lastname); ?></td>
                                        <td><?php echo e($item->username); ?></td>
                                        <td><?php echo e($item->wallet); ?></td>
                                        <td><?php echo e($item->w_amt); ?></td>
                                        <td><?php echo e($item->last_wd); ?></td>
                                        <td><?php echo e($item->package); ?></td>
                                        <td><?php echo e($item->status); ?></td>
                                        <td><?php echo e($item->date_invested); ?></td>
                                        <td><?php echo e($item->end_date); ?></td>
                                        <td>
                                            <form action="">
                                                <button id="correct" type="submit" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#correctModal">Correct</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/admin/manage_funds.blade.php ENDPATH**/ ?>