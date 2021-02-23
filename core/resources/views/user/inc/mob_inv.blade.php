{{--                 
<div class="alert alert-info inv_alert_cont" >
    <div class="row inv_alert_top_row">
        <div class="col-xs-12 pad_top_5" align="center" >
            <h4 class="u_case">{{ __('') }}Package: {{$in->package}}</h4>
           
        </div>
    </div> 
    <div class="row color_blue_9">
        <div class="col-xs-6">
            {{ __('Capital:') }}
        </div>
        <div class="col-xs-6">
            {{($settings->currency)}} {{$in->capital}}
        </div>
    </div> 
    <div class="row" style="">
        <div class="col-xs-6">
            {{ __('Return:') }}
        </div>
        <div class="col-xs-6">
            {{($settings->currency)}} {{$in->i_return}}
        </div>
    </div>   --}}
    {{-- <div class="row" style="">
        <div class="col-xs-6">
            {{ __('Started:') }}
        </div>
        <div class="col-xs-6">
            {{$in->date_invested}}
        </div>
    </div>  --}}
    {{-- <div class="row" style="">
        <div class="col-xs-6">
            {{ __('Ending:') }}
        </div>
        <div class="col-xs-6">
            {{$in->end_date}}
        </div>
    </div>
    <div class="row" style="">
        <div class="col-xs-6">
            {{ __('Days spent:') }}
        </div>
        <div class="col-xs-6">
            {{$totalDays}}
        </div>
    </div> --}}
    {{-- <div class="row" style="">
        <div class="col-xs-6">
           {{ __('Withdrawn:') }} 
        </div>
        <div class="col-xs-6">
            {{($settings->currency)}} {{$in->w_amt}}
        </div>
    </div>  --}}
    {{-- <div class="row" style="">
        <div class="col-xs-6">
            {{ __('Status:') }}
        </div>
        <div class="col-xs-6">
            {{$in->status}}
        </div>
    </div> 
    <div class="row" style="" align="center">
        <br>
        <div class="col-xs-12" align="center">
            <a title="Withdraw" href="javascript:void(0)" class="btn btn-info" onclick="wd('pack', '{{$in->id}}', '{{$ern}}', '{{$withdrawable}}', '{{$Edays}}', '{{$ended}}')">
                {{$settings->currency}} {{$ern}}
            </a>
        </div>
        {{ __('Click to withdraw') }}
    </div>                                                                     
</div> --}}

<div class="shadow card">
    <div class="card-header fw-bold h2">
        Gold <span>Package</span>
        <em>$</em><div class="card-title fw-bolderh">30</div>
    </div>

    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
                {{ _("Return") }}
              <span class="badge bg-primary rounded-pill lh-1">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
              {{ _("Ending") }}
              <span class="badge bg-primary rounded-pill lh-1">2</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
              {{ _("Days Spent") }}
              <span class="badge bg-primary rounded-pill">1</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center lh-1">
                {{ _("Status") }}
                <span class="badge bg-green rounded-pill"></span>
              </li>
          </ul>
    </div>

    <div class="card-footer" align="center">
        <div class="mx-auto d-grid col-6">
            <a title="Withdraw" href="javascript:void(0)" class="btn btn-primary" onclick="wd('pack', '{{$in->id}}', '{{$ern}}', '{{$withdrawable}}', '{{$Edays}}', '{{$ended}}')">
                {{$settings->currency}} {{$ern}}
            </a>
          </div>
    </div>
</div>
        
