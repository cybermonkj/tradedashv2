<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="p-2 shadow card">
            <form action="<?php echo e(route('coupon.deposit')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon">$</span>
                    <input type="number" class="form-control" placeholder="30" name="amount" aria-label="amount" aria-describedby="basic-amount">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-secret"></i></span>
                    <input type="text" class="form-control" placeholder="Deposit" name="deposit_code" aria-label="code" aria-describedby="basic-code">
                </div>
    
                <div class="py-4">
                    <input type="submit" value="Validate" class="btn btn-info">
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.atlantis.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/user/components/deposit_modal.blade.php ENDPATH**/ ?>