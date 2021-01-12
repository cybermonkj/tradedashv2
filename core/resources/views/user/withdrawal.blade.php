@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
        <div class="main-panel">
            <div class="content">
                @php($breadcome = 'Withdrawal')
                @include('user.atlantis.main_bar')
                <div class="page-inner mt--5">
                    @include('user.atlantis.overview')
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('Withdrawal History') }}</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">                                        
                                        <table id="basic-datatables" class="display table table-striped table-hover" >
                                            <thead>
                                                <tr>                                                   
                                                    <th>{{ __('Date') }}</th> 
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Account') }}</th>
                                                    <th>{{ __('Amount') }}</th>                                                   
                                                    <th>{{ __('Status') }}</th>                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $activities = App\withdrawal::where('user_id', $user->id)->orderby('id', 'desc')->get();
                                                ?>
                                                @if(count($activities) > 0 )
                                                    @foreach($activities as $activity)
                                                        <tr>
                                                            <td>{{$activity->created_at}}</td>
                                                            <td>{{$activity->package}}</td>
                                                            <td>{{$activity->account}}</td>
                                                            <td>{{$settings->currency.' '.$activity->amount}}</td>
                                                            <td>{{$activity->status}}</td>
                                                                                 
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            @include('user.inc.confirm_inv')

@endSection
            