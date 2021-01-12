<?php
    $st = App\site_settings::find(1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Withdrawal Notification</title>
</head>
<body>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" style="border:1px solid #CCC; padding:4%; box-shadow:2px 2px 4px 4px #CCC;">
            <div align="">
        		<img src="{{env('APP_URL')}}/img/{{$st->site_logo}}" style="height:100px; width:100px;" align="center">
        	</div>
        	<h3 align="">Withdrawal Notification</h3>
        	<p>
        	   Hi, <b>{{$md['username']}}</b> your withdrawal request on {{env('APP_URL')}} has been created successfully.
        	   <br>
        	   Kindly wait while your withdrawal is bieng Processed by the System. Depending on what method you used withdrawal time may vary. Bank transactions shall be resolved within 24hours on bussines days.
        	</p>
        	<p>
        		<i class="fa fa-certificate">{{$st->site_title}} .
        	</p>
        </div>
    </div>
	
</body>
</html>