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
							<h1 class="text-capitalize display-6">Coupon Codes</h1>
						</div>

						<div class="p-4 shadow card" style="width: 100% !important">
							@include('admin.components.table')
						</div>

						<div class="px-4 my-4">
							<div class="row">
								<a style="color: #fff !important" class="btn btn-success btn-lg text-capitalize" href="{{ route('export.codes') }}">Export Coupons</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection