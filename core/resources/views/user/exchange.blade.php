@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')


<div class="main-panel">
    <div class="content">

        {{-- <style>
                .iframe-container {
                position: relative;
                overflow: hidden;
                padding-top: 56.25%;
                }
                .iframe-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
                }
        </style> --}}
        {{-- @php($breadcome = 'Crypto Exhange wallet ()')
        @include('user.atlantis.main_bar')
        {{-- <div class="page-inner mt--5">
            @include('user.atlantis.overview')
            <div id="prnt"></div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">{{ __('Crypto Exhange wallet') }}</div>                                       
                            </div>
                        </div> --}}
                        <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


                                {{-- <div class="card-body">   --}}
                                        <div>

                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                                How it Works
                                            </button>

                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                                Crypto to Fiat
                                            </button>

                                            <iframe 
                                            src="https://dash.tradepander.com/exchange/" 
                                            name="Exchange" 
                                            title="Exchange" 
                                             frameborder="0" 
                                            style="display: block; border: none;  width: 100%" 
                                            {{--allowpaymentrequest= "true" --}}
                                            scrolling="yes"
                                            width="100%"
                                            height="1000"
                                            loading="eager"
                                            allowfullscreen="true"
                                            allowpaymentrequest="true"
                                            sandbox="allow-top-navigation allow-scripts allow-forms allow-pointer-lock allow-popups"   
                                            >
                                        </iframe>
                                            
                                                </div>
                                            </div>
                                        </div> 

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


@endSection
            