@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
    <div class="main-panel">
      <div class="content">
        @php($breadcome = 'Send Fund')
        @include('user.atlantis.main_bar')
        <div class="page-inner mt--5">
          @include('user.atlantis.overview')
          <div id="prnt"></div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="card">

                <div class="card-header">
                  <div class="card-title"> Fund Transfer </div>
                </div>

                <div class="card-body pb-0">                 
                    @if(Session::has('err_send'))
                        <div class="alert alert-danger">
                            {{Session::get('err_send')}}
                        </div>
                        {{Session::forget('err_send')}}
                    @endif
                    <div class="">                        
                        <form action="/user/send/fund" method="post" enctype="multipart/form-data">
                          <div class="form-group" align="left">                       
                              <input type="hidden" class="regTxtBox" name="_token" value="{{csrf_token()}}">
                          </div>                                                    
                          <div class="input-group pad_top10" >
                            <div class="input-group-prepend" >
                              <span class="input-group-text "><i class="fa fa-user"></i></span>
                            </div>                        
                            <input type="text" class="form-control" name="usn"  required placeholder="Username" >
                          </div>
                          <div class="input-group pad_top10">
                            <div class="input-group-prepend" >
                              <span class=" input-group-text ">{{$settings->currency}}</span>
                            </div>                                                     
                            <input type="text" class="form-control" name="s_amt"  required placeholder="Enter amount you want to send" >
                          </div>
                                        
                          <div class="form-group" align="">
                            <br><br>
                              <button class="btn btn_blue">{{ __('Send') }}</button>
                              <br>
                          </div>                          
                        </form>  
                        <br><br>                    
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Transfer History </div>
                </div>
                <div class="card-body">
                    @include('user.inc.transfer')
                </div>
              </div>
            </div>
            
          </div> 

          <div class="row">
            
          </div>        
          
        </div>
      </div>

       @include('user.inc.confirm_inv')

@endSection