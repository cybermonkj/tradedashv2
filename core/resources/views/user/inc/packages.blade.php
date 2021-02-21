<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,400;0,600;0,700;0,800;1,400&family=Open+Sans:ital,wght@0,600;0,800;1,400;1,700&display=swap");*{margin:0;padding:0;box-sizing:border-box;list-style-type:none;text-decoration:0}html,body{width:100%;height:100%;font-family:'Nunito', sans-serif}.transition,.card-custom{transition:all 0.1s 0s ease}.grid-container{display:grid}.card-custom{padding:1rem;border-radius:1rem;margin-bottom:2rem;overflow:hidden;min-height:290px;box-shadow:0 5px 10px rgba(33,33,33,0.2)}.card-custom:hover{box-shadow:0 5px 10px rgba(33,33,33,0.3)}.card-custom__header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem}.card-custom__header .section{display:flex;justify-content:space-between;align-items:flex-start;padding-top:.4rem}.card-custom__header .media{height:3.1rem;width:3.1rem;border-radius:.5rem;background:#0cb870;position:relative;overflow:hidden;box-shadow:0 4px 8px rgba(33,33,33,0.1)}.card-custom__header .media::before{content:"";position:absolute;top:0;right:0;width:1.6rem;height:1.6rem;background:#0fe88d;border-radius:50%;transform:translateY(-0.1rem);margin-right:-.1rem}.card-custom__header .media::after{content:"";position:absolute;bottom:0;left:0;width:1.6rem;height:1.4rem;background:#0fe88d;border-bottom-left-radius:.8rem;transform:translateY(0.2rem);margin-left:-.1rem}.card-custom__header .group{margin-left:1rem;display:flex;flex-direction:column;line-height:25px}.card-custom__header .tag{background-color:#150ed3;padding:.4rem .8rem;border-radius:1rem;font-size:.6rem;text-transform:uppercase;color:#fff;font-weight:bold;letter-spacing:1.5pt;user-select:none}.card-custom__header .tag--2{background-color:#E0E0E0 !important;color:#212121 !important}.card-custom__title{text-transform:capitalize;font-size:1.4rem;font-weight:600;color:#212121}.card-custom__subtitle{color:#3b3b3b;font-size:.8rem;display:flex;align-items:flex-start;font-family:'Open Sans', sans-serif;font-weight:200}.card-custom__subtitle div[name=price]{font-weight:700;font-size:1.8rem;color:#1c1c1c}.card-custom__subtitle span{color:#9E9E9E;transform:translateY(0.4rem);font-size:.8rem}.card-custom__body{margin:1rem 0}.list-custom:not(:last-child){margin-bottom:0rem !important}.list-custom__item{display:flex;align-items:center;justify-content:space-between;text-transform:capitalize;font-size:1.1rem;margin-bottom:.2rem}.list-custom__item strong{width:22%;font-family:'Open Sans', sans-serif;color:#2e2e2e}.list-custom__group{display:flex;align-items:center}.list-custom__group span{margin-left:.5rem;color:#424242}.list-custom__disc{width:1rem;height:1rem;color:#757575}.divider{background:rgba(224,224,224,0.8);height:1px;box-shadow:0 2px 4px rgba(189,189,189,0.2)}.btn{width:100%;border:none;outline:none;cursor:pointer;border-radius:8px;background:#100ba3;color:#fff;display:flex;align-items:flex-end;justify-content:center;padding:.5rem 1rem;box-shadow:0 5px 10px rgba(33,33,33,0.2)}.btn span{text-transform:capitalize;font-size:1.2rem;letter-spacing:.5pt;margin-right:1rem}.btn__icon{width:1.2rem;height:1.2rem}.btn:hover{transform:scale(1.01);background:#120dbb;box-shadow:0 5px 20px rgba(33,33,33,0.2)}@media (min-width: 620px){body{display:grid;place-content:center;place-items:center}.row{flex-direction:row;justify-content:flex-start}.card-custom{margin-right:1rem}}
    /*# sourceMappingURL=card.min.css.map */
</style>

<div class="sparkline8-graph dashone-comment dashtwo-messages">
    <div class="comment-phara">
        <div class="row comment-adminpr">
            <?php                
                $invs = App\packages::where('status', 1)->orderby('id', 'asc')->get();                
            ?>
            @if($user->phone != '')
                @if(isset($invs) && count($invs) > 0)
                    @foreach($invs as $inv)

                        <div class="col col-sm-12 col-md-6 col-lg-4">
                            <div class="card-custom">
                                <div class="card-custom__header">
                                    <div class="section">
                                        <div class="media"></div>
                                        <div class="group">
                                            <div class="card-custom__title">{{ $inv->package_name }}</div>
                                            <div class="card-custom__subtitle"><div>$</div><div name="price">{{ $inv->min }}</div><span>/month</span></div>
                                        </div>
                                    </div>
                                    @if ($inv->package_name == "Rush")
                                        <div class="tag">popular</div>
                                    @endif
                                    
                                    @if($inv->package_name <> "Rush")
                                        <div class="tag tag--2">package</div>
                                    @endif
                                    
                                </div>
                    
                                <div class="divider"></div>
                                    
                                <div class="card-custom__body">
                                    <ul class="list-custom">
                                        <li class="list-custom__item">
                                            <div class="list-custom__group">
                                                <svg class="list-custom__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                <span>min investment </span>
                                            </div>
                    
                                            <strong>{{ $inv->currency }} {{ $inv->min }}</strong>
                                        </li>
                                        <li class="list-custom__item">                        
                                            <div class="list-custom__group">
                                                <svg class="list-custom__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                <span>max investment</span>
                                            </div>
                    
                                            <strong>{{ $inv->currency }} {{ $inv->max }}</strong>
                                        </li>
                                        <li class="list-custom__item">                        
                                            <div class="list-custom__group">
                                                <svg class="list-custom__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                <span>Total interest</span> 
                                            </div>
                    
                                            <strong>{{$inv->daily_interest*$inv->period*100}}%</strong>
                                        </li>
                                        <li class="list-custom__item">
                                            
                                            <div class="list-custom__group">
                                                <svg class="list-custom__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                <span>Days</span>
                                            </div>
                    
                                            <strong>{{ $inv->period }}</strong>
                                        </li>
                                    </ul>
                                </div>
                    
                                <div class="card-custom__footer">
                                    <button id="{{$inv->id}}" class="btn" onclick="confirm_inv('{{$inv->id}}', '{{$inv->package_name}}', '{{$inv->period}}', '{{$inv->daily_interest}}', '{{$inv->min}}', '{{$inv->max}}', '{{$user->wallet}}')">
                                        <span>invest</span>
                                        <svg class="btn__icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd">
                                        </path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--    End of new card-->
                        
                        {{-- <div class="col-sm-4">
                            <div class="panel card pack-container" style="" align="center">
                                <div class="panel-head" style="">
                                    <h3 class="txt_transform">{{$inv->package_name}} {{ __('Package') }}</h3>
                                </div>
                                <div class="" align="center" >
                                    <br>
                                        <h4 class="u_case" >
                                            <strong>{{ __('Period of Investment') }}</strong>
                                        </h4>
                                        <div style="font-size: 40px;">
                                            <b>
                                                {{$inv->period}}
                                            </b>
                                        </div>
                                        <span class="pk_num">
                                                {{__('Days')}}
                                        </span>
                                </div>
                                <span align="center">..............................</span>
                                <div class="" align="center" style="">
                                        <h4 class="u_case" >
                                            <strong>{{ __('Min Investment') }}</strong>
                                        </h4>
                                        <span class="pk_num">{{$settings->currency}} {{$inv->min}}</span>
                                        <h4 class="u_case">
                                            <strong>{{ __('Max Investment') }}</strong>
                                        </h4>
                                        <span class="pk_num">{{$settings->currency}} {{$inv->max}}</span>
                                </div>                                                    
                                
                                <span align="center">..............................</span>
                                <div class="" align="center">
                                    <h4 class="u_case">
                                        <strong>Total Interest</strong>
                                    </h4>         
                                     <span class="pk_num">{{$inv->daily_interest*$inv->period*100}}%</span>
                                </div>
                                 <div class="" align="center">
                                    <h4 class="u_case">
                                       <strong> Withdrawal Interval</strong>
                                    </h4> 
                                    <span class="pk_num">{{$inv->days_interval}} Days</span>
                                </div>
                                <div class="" align="center">
                                    <p>{{ __('Capital accessible after investment elapses.') }}</p>
                                </div>
                                <div class="" align="center">
                                        <a id="{{$inv->id}}" href="javascript:void(0)" class="collcc btn btn-info" onclick="confirm_inv('{{$inv->id}}', '{{$inv->package_name}}', '{{$inv->period}}', '{{$inv->daily_interest}}', '{{$inv->min}}', '{{$inv->max}}', '{{$user->wallet}}')">
                                            {{ __('Invest') }}
                                        </a>
                                        <br><br>
                                </div>
    
                            </div>
                        </div> --}}
                                                                          
                    @endforeach
                @endif
            @else
                <div class="alert alert-warning">
                    <a href="/{{$user->username}}/profile#userdet">{{ __('Please, click here to update your profile before you can invest.') }}</a>
                </div>
            @endif
        </div>
    </div>
</div>