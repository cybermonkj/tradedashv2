<div class="sparkline8-graph dashone-comment dashtwo-messages">
    <div class="comment-phara">
        <div class="row comment-adminpr">
            <?php                
                $invs = App\packages::where('status', 1)->orderby('id', 'asc')->get();                
            ?>
            <?php if($user->phone != ''): ?>
                <?php if(isset($invs) && count($invs) > 0): ?>
                    <?php $__currentLoopData = $invs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                                                                          
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    <a href="/<?php echo e($user->username); ?>/profile#userdet"><?php echo e(__('Please, click here to update your profile before you can invest.')); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/user/inc/packages.blade.php ENDPATH**/ ?>