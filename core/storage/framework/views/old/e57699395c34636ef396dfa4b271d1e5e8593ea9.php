<?php
    $st = App\site_settings::find(1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tickect Message</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" style="border:1px solid #CCC; padding:4%; box-shadow:2px 2px 4px 4px #CCC;">
            <div align="">
                <img src="<?php echo e(env('APP_URL')); ?>/img/<?php echo e($st->site_logo); ?>" style="height:100px; width:100px;" align="center">
            </div>
            <h3 align="">New Tickect</h3>
            <p>
               Hi Support, <b><?php echo e($md['username']); ?></b> has left a new message on <?php echo e(env('APP_URL')); ?>.
               <br>
               Kindly attend to this message as soon as possible.               
            </p>
            <p>
                <i class="fa fa-certificate"><?php echo e(env('APP_NAME')); ?>.
            </p>
        </div>
    </div>
    
</body>
</html><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/mail/user_tickect_msg.blade.php ENDPATH**/ ?>