@extends('admin.atlantis.layout')
@Section('content')
	<div class="main-panel">
		<div class="content">
			@include('admin.atlantis.main_bar')
			<div class="page-inner mt--5">
				@include('admin.atlantis.overview')
				<div class="container">
					<div class="row align-items-start">
						<div class="col-12 col-sm-12">
							<h1 class="text-uppercase display-5">Coupon Codes</h1>
						</div>

						<div class="p-4 shadow card">
							@include('admin.components.table')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection