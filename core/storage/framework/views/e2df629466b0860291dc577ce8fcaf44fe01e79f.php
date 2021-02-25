
    
    
    
    

<div class="shadow card">
    <div class="card-header fw-bold h2">
        Gold <span>Package</span>
        <em>$</em><div class="card-title fw-bolderh">30</div>
    </div>

    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
                <?php echo e(_("Return")); ?>

              <span class="lh-1"><?php echo e(($settings->currency)); ?> <?php echo e($in->i_return); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
              <?php echo e(_("Ending")); ?>

              <span class="lh-1"><?php echo e($in->end_date); ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
              <?php echo e(_("Days Spent")); ?>

              <span cla><?php echo e($totalDays); ?></span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
                <?php echo e(_("Status")); ?>

                <span class=""><?php echo e($in->status); ?></span>
              </li>
          </ul>
    </div>

    <div class="card-footer" align="center">
          <div class="d-grid">
            <a title="Withdraw" href="javascript:void(0)" class="btn btn-primary" onclick="wd('pack', '<?php echo e($in->id); ?>', '<?php echo e($ern); ?>', '<?php echo e($withdrawable); ?>', '<?php echo e($Edays); ?>', '<?php echo e($ended); ?>')">
                <?php echo e($settings->currency); ?> <?php echo e($ern); ?>

            </a>
          </div>
    </div>
</div>
        
<?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/user/inc/mob_inv.blade.php ENDPATH**/ ?>