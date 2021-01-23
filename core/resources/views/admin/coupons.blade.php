<?php
	<ul>
		@foreach($coupons as $coupon)
		<li>{{ $coupon->coupon_code }}</li>	
		@endforeach
	</ul>
?>