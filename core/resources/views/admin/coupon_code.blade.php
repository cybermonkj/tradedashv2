@extends('admin.atlantis.layout')
@Section('content')
	<div class="main-panel">
		<div class="content">
			@include('admin.atlantis.main_bar')
			<div class="page-inner mt--5">
				@include('admin.atlantis.overview')
				div id="prnt"></div>
				<div class="row">
					<h1 class="heading">Coupons Codes</h1>
				</div>
			</div>
		</div>
	</div>
@endsection