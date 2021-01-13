@include('user.inc.fetch')
@extends('layouts.atlantis.layout')
@Section('content')
        <div class="main-panel">
            <div class="content">
                @php($breadcome = 'Support Chats')
                @include('user.atlantis.main_bar')
                <div class="page-inner mt--5">                    
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title col-sm-12"  >{{ __('Support Channel') }} 
                                            <span class="float-right"><a data-target="#open_ticket" data-toggle="modal" href="javascript:void(0)" class="btn btn_blue text-white"><i class="fas fa-plus-circle "></i>New Support Request</a></span>
                                        </div>
                                    </div>
                                     
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">                                        
                                        <table  class=" display table table-striped table-hover" >
                                            <thead>
                                                <tr>                                                   
                                                    <th>{{ __('Ticket ID') }}</th> 
                                                    <th>{{ __('Title') }}</th>
                                                    <th>{{ __('status') }}</th>
                                                    <th>{{ __('Action') }}</th>                                                   
                                                    <!-- <th>{{ __('Status') }}</th>                                   -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @if(!empty($tickets))
                                                    @foreach($tickets as $ticket)
                                                        <tr>
                                                            <td>{{$ticket->ticket_id}}</td>
                                                            <td>{{$ticket->title}}</td>
                                                            <td>
                                                                @if($ticket->status == 0)
                                                                    {{__('Closed')}}
                                                                @elseif($ticket->status == 1)
                                                                    {{__('Open')}}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a title="View Chat" href="/ticket/{{$ticket->id}}" class="btn btn_blue">
                                                                    <i class="fab fa-teamspeak"></i>
                                                                    @php($rd=0)
                                                                    @foreach($ticket->comments as $comment)
                                                                        @if($comment->state == 1 && $comment->sender == 'support')
                                                                            @php($rd = 1)
                                                                        @endif
                                                                    @endforeach
                                                                    @if(isset($rd) && $rd == 1)
                                                                        <i class="fa fa-circle new_not"></i>
                                                                        @php($rd = 0)
                                                                    @endif
                                                                </a>
                                                                @if($ticket->status == 0)
                                                                    <a title="Close Ticket" href="{{ route('ticket.close', $ticket->id)}}" class="btn btn-warning">
                                                                        <i class="fas fa-stop-circle"></i>
                                                                    </a>
                                                                @endif
                                                                
                                                            </td>                                                                                 
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    
                                                @endif
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    {{$tickets->links()}}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
			
			<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="#" rel="noopener" target="_blank"><span class="blue-text">Cryptocurrency Markets</span></a> We are glad to announce that our New ICO Token would be coming live In March</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
  {
  "width": 1000,
  "height": 490,
  "defaultColumn": "overview",
  "screener_type": "crypto_mkt",
  "displayCurrency": "USD",
  "colorTheme": "light",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->

            @include('user.inc.confirm_inv')

            <!-- Modal -->
            <div class="modal fade" id="open_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Open a support request ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="text-danger">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" method="POST" role="form" action="{{ route('ticket.create') }}" >
                        @csrf
                        <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label class="control-label">{{ __('Problem') }}</label>                            
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pen-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="title" value="" required autofocus>                    
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label">{{ __('More Detail) }}</label>                            
                            <div class="input-group">                               
                                <textarea name="msg" class="form-control" required></textarea>                                                   
                            </div>
                        </div>
                        <div class="form-group">                                                                                                           
                            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>  
                        </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>

@endSection
            