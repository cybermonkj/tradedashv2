<table class="table table-hover">
    <thead>
        <tr>
            
            <th scope="col">ID Number</th>
            <th scope="col">Coupon Code</th>
            <th scope="col">Status</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Updated</th>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($coupon->id); ?></td>
                <td><?php echo e($coupon->coupon_code); ?></td>
                <td>
                    <?php if($coupon->is_used == true): ?>
                        <span>Used</span>
                    <?php endif; ?>
                    <?php if($coupon->is_used == false): ?>
                        <span>Not Used</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($coupon->created_at); ?></td>
                <td><?php echo e($coupon->updated_at); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/admin/components/table.blade.php ENDPATH**/ ?>