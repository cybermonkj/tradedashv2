<style>
    .flex-section {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center;

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
                  
                    <div class="p-3 mb-2 bg-light text-dark flex-section flex-sm-column">
                        <p class="text-muted text-justify" style="font-size: 1.4rem;">Manually Update User Wallet</p>
                        <button class="btn btn-success" data-toggle="modal" data-target="#updateModal">Update</button>
                    </div>


                    <!--    Modals Start   -->
                        <div class="modal fade" id="correctModal" tabindex="-1" aria-labelledby="correctLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="correctlLabel">Correct Balance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                    ...
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>


                        <!--    Second  -->

                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="updateLabel">Change Wallet Balance</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        ...
                                      </div>

                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>

                    <!--    Modals End  -->
                    
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
                                        <button id="correct" type="submit" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#correctModal">Correct</button>
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

    <script>
        document.querySelector('#correct').addEventListener('click', (e) => {
            e.preventDefault();
        });
    </script>
@endsection