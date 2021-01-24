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
							<h1 class="display-3">Coupons Codes</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection