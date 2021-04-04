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

                    @if (Session::has('msgTest'))
                        <div class="alert alert-info">{{ Session::get('msgTest') }}</div>
                    @endif
                    


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
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="userid">Actual Balance</label>
                                            <input type="number" name="wallet" id="wallet" class="form-control" aria-describedby="walletHelp" required>
                                            <small id="walletHelp" class="form-text text-muted">Enter the user's actaul balance to update his wallet.</small>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-send2">Update</button>
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
                                <form method="post" action="/admin/change/balance" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" aria-describedby="usernameHelp" required>
                                            <small id="usernameHelp" class="form-text text-muted">Enter the user's username.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="wallet">Actual Balance</label>
                                            <input type="number" name="wallet" id="wallet" class="form-control" aria-describedby="walletHelp" required>
                                            <small id="walletHelp" class="form-text text-muted">Enter the user's actaul balance to update his wallet.</small>
                                        </div>
                                      </div>

                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary btn-send">Change</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>

                    <!--    Modals End  -->
                    
                    {{-- <div class="card p-2">
                        @php
                            print_r($bundle);
                        @endphp
                    </div> --}}
                    
					<div class="card p-4">
                        <table class="table table-hover table-bordered mt-4">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Wallet</th>
                                <th scope="col">Withdrawable Amt</th>
                                <th scope="col">Last Withdrawable</th>
                                <th scope="col">Packages</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Invested</th>
                                <th scope="col">End Date</th>
                                <th scope="col">action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($bundle); $i++)
                                    <tr>
                                        <th scope="row">{{ $i+1 }}</th>
                                        <td>{{ $bundle[$i].id }}</td>
                                        <td>{{ $bundle[$i].firstname ." ". $bundle[i].lastname }}</td>
                                        <td>{{ $bundle[$i].username }}</td>
                                        <td>{{ $bundle[$i].wallet }}</td>
                                        <td>{{ $bundle[$i].w_amt }}</td>
                                        <td>{{ $bundle[$i].last_wd }}</td>
                                        <td>{{ $bundle[$i].package }}</td>
                                        <td>{{ $bundle[$i].status }}</td>
                                        <td>{{ $bundle[$i].date_invested }}</td>
                                        <td>{{ $bundle[$i].end_date }}</td>
                                        <td>
                                            <form action="">
                                                <button id="correct" type="submit" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#correctModal">Correct</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
@endsection