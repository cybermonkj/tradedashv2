<?php
    $st = App\site_settings::find(1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Confirmation</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" style="border:1px solid #CCC; padding:5%; ">
            <div align="">
        		<img src="<?php echo e(env('APP_URL')); ?>/img/<?php echo e($st->site_logo); ?>" style="height:100px; width:100px;" align="center">
        	</div>
        	<h3 align="">Hi <?php echo e($md['usr']); ?>, </h3>
        	<p>
        	    You've taken a bold step for registering with us at <a href="<?php echo e(env('APP_URL')); ?>"><b><?php echo e(env('APP_NAME')); ?></b></a><br>
        		To complete your registration and begin investing with us, please click the link below to activate your account.<br> We look forward to great achivements and Returns on Iinvestment. Once more, we say welcome
        		<br>
        		<a class="btn btn-info" href="<?php echo e(env('APP_URL')); ?>/registration/confirm/<?php echo e($md['usr']); ?>/<?php echo e($md['token']); ?>"><b>Confirm Registration</b></a>
        	</p>
        	<p>
        		<i class="fa fa-certificate"></i>Thanks for registering at <?php echo e(env('APP_NAME')); ?>.
        	</p>
        </div>
    </div>
	
</body>
</html><?php /**PATH /home/v2.tradepander.com/public_html/core/resources/views/mail/regconfirm.blade.php ENDPATH**/ ?>