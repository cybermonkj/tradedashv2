<style>
    .flex-section {
        display: flex !important;
        justify-content: space-between !important;
        align-items: 

    }
</style>

@extends('admin.atlantis.layout')
@Section('content')
	<div class="main-panel">
		<div class="content">
			@include('admin.atlantis.main_bar')
			<div class="page-inner mt--5">
				@include('admin.atlantis.overview')
				<div class="container mt-4">
                  
                    <div class="p-3 mb-2 bg-light text-dark d-flex justify-content-between flex-row flex-sm-column">
                        <p class="text-muted">Manually Update User Wallet</p>
                        <button class="btn btn-success">Update</button>
                    </div>
                    
					<div class="card p-4">
                        <table class="table table-hover table-bordered mt-4">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Wallet</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Time Stamp</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>1</td>
                                <td>John Snow</td>
                                <td>Snowx</td>
                                <td>$15</td>
                                <td>Rush</td>
                                <td>2020-03-21-15:21</td>
                                <td>
                                    <form action="">
                                        <button id="process" type="submit" class="btn btn-sm btn-warning">correct</button>
                                    </form>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection