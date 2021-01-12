@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
        <div class="main-panel">
            <div class="content">
                @php($breadcome = 'My Investments')
                @include('user.atlantis.main_bar')
                <div class="page-inner mt--5">
                    @include('user.atlantis.overview')
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('My Investment') }}</div>                                       
                                    </div>
                                </div>
                                <div class="card-body ">  
                                    <div class="table-responsive web-table">
                                        <table class="display table table-hover" >
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Package') }}</th>
                                                    <th>{{ __('Capital') }}</th>
                                                    <th>{{ __('Date Invested') }}</th> 
                                                    <th>{{ __('Elapse') }}</th>  
                                                    <th>{{ __('Days Spent') }}</th> 
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Earning') }}</th>  
                                                    <th>{{ __('Action') }}</th> 
                                                </tr>
                                            </thead>
                                            <tbody class="web-table">                                                
                                                @if(count($actInv) > 0 )
                                                    @foreach($actInv as $in)
                                                        <?php
                                                           
                                                            $totalElapse = getDays(date('Y-m-d'), $in->end_date);
                                                            if($totalElapse == 0)
                                                            {
                                                                $lastWD = $in->last_wd;
                                                                $enddate = ($in->end_date);
                                                                $Edays = getDays($lastWD, $enddate);
                                                                $ern  = $Edays*$in->interest*$in->capital;
                                                                $withdrawable = $ern;              
                                                                $totalDays = getDays($in->date_invested, $in->end_date);
                                                                $ended = "yes";
                                                            }
                                                            else
                                                            {
                                                                $lastWD = $in->last_wd;
                                                                $enddate = (date('Y-m-d'));
                                                                $Edays = getDays($lastWD, $enddate);
                                                                $ern  = $Edays*$in->interest*$in->capital;
                                                                $withdrawable = 0;
                                                                if ($Edays >= $in->days_interval)
                                                                {
                                                                    $withdrawable = $in->days_interval*$in->interest*$in->capital;
                                                                }
                                                                                               
                                                                $totalDays = getDays($in->date_invested, date('Y-m-d'));
                                                                $ended = "no";
                                                            }
                                                        ?>
                                                        <tr class="">
                                                            <td>{{$in->package}}</td>
                                                            <td>{{($settings->currency)}} {{$in->capital}}</td>     
                                                            <td>{{$in->date_invested}}</td>
                                                            <td>{{$in->end_date}}</td> 
                                                            <td>{{$totalDays}}</td>
                                                            <td>{{$in->status}}</td>
                                                            <td>{{$settings->currency}} {{$ern}} </td>
                                                            <td>
                                                                <a title="Withdraw" href="javascript:void(0)" class="btn btn-info" onclick="wd('pack', '{{$in->id}}', '{{$ern}}', '{{ $withdrawable }}', '{{$Edays}}', '{{$ended}}')">
                                                                    <i class="fas fa-arrow-down"></i>
                                                                </a>
                                                            </td>           
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="text-right col-md-12">{{ $actInv->links() }}</div>
                                    </div>

                                    <div class="mobile_table container messages-scrollbar" >
                                                    
                                        @if(count($actInv) > 0 )
                                            @foreach($actInv as $in)
                                                <?php

                                                    $totalElapse = getDays(date('y-m-d'), $in->end_date);
                                                    if($totalElapse == 0)
                                                    {
                                                        $lastWD = $in->last_wd;
                                                        $enddate = ($in->end_date);
                                                        $Edays = getDays($lastWD, $enddate);
                                                        $ern  = $Edays*$in->interest*$in->capital;
                                                        $withdrawable = $ern;
                                                                                             
                                                        $totalDays = getDays($in->date_invested, $in->end_date);
                                                        $ended = "yes";

                                                    }
                                                    else
                                                    {
                                                        $lastWD = $in->last_wd;
                                                        $enddate = (date('Y-m-d'));
                                                        $Edays = getDays($lastWD, $enddate);
                                                        $ern  = $Edays*$in->interest*$in->capital;
                                                        $withdrawable = 0;
                                                        if ($Edays >= $in->days_interval)
                                                        {
                                                            $withdrawable = $in->days_interval*$in->interest*$in->capital;
                                                        }
                                                                                       
                                                        $totalDays = getDays($in->date_invested, date('Y-m-d'));
                                                        $ended = "no";
                                                    }

                                                ?>
                                                 
                                                @include('user.inc.mob_inv')                                
                                                
                                            @endforeach
                                        @else
                                            
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"> Available Packages</div>
                                </div>
                                <div class="card-body pb-0">
                                    @include('user.inc.packages')
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    
                </div>
            </div>

    @include('user.inc.confirm_inv')
    @include('user.inc.withdrawal')

@endSection
            