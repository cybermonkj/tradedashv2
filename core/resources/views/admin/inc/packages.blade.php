<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700&display=swap");*{margin:0;padding:0;box-sizing:border-box;list-style-type:none;text-decoration:none;transition:all 0.1s 0s ease}html,body{width:100%;height:100%;font-family:'Roboto', sans-serif}.main-grid{width:100%;height:100%;border:1px solid red;padding:2rem;display:grid;grid-template-columns:1fr;grid-template-rows:2fr 2fr;grid-gap:1rem}.divider{width:100%;border-top:1px solid #BDBDBD}.card{border-radius:1rem;min-height:280px;padding:1rem;margin-bottom:1rem;display:flex;flex-direction:column;box-shadow:0 6px 15px rgba(33,33,33,0.2)}.card__header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem}.card__section{display:flex;align-items:center}.card__section .group{margin-left:1rem}.card__title{display:flex;align-items:flex-start;font-size:.8rem;color:#474747}.card__title span{font-size:1.5rem;font-weight:bold;color:#141414}.card__media{position:relative;width:3.5rem;height:3.5rem;border-radius:0.5rem;background:#ccac00;overflow:hidden;box-shadow:0 4px 8px rgba(0,0,0,0.2)}.card__media::before{content:"";height:1.75rem;width:1.75rem;background:#ffdb1a;border-radius:50%;position:absolute;right:-1px;top:-5%;transform:translateY(5%)}.card__media::after{content:"";width:1.75rem;height:1.4rem;background:#ffdb1a;position:absolute;bottom:0}.card__chip{text-transform:uppercase;font-size:.6rem;font-weight:600;color:#000;letter-spacing:1pt;background:#e6c200;padding:.4rem .6rem;border-radius:1rem;position:relative;overflow:hidden}.card__chip::before{content:"";width:100%;height:100%;background:rgba(255,215,0,0.23);border-radius:50%;position:absolute}.card__body{padding:1rem 0}.card__footer{display:flex}.card__footer .btn{display:flex;align-items:center;justify-content:space-between;width:100%;border:none;outline:none;border-radius:.3rem;padding:.6rem 1rem;background:#6e4c1e;color:#fff;font-weight:600;cursor:pointer;box-shadow:0 4px 8px rgba(0,0,0,0.2)}.card__footer .btn__icon{width:1.2rem;height:1.2rem}.card__footer .btn:hover{transform:scale(1.01);background:#5a3e19}.list__item{display:flex;justify-content:space-between;font-size:.95rem;font-weight:500;color:#212121;text-transform:capitalize}.list__item:not(:last-child){margin-bottom:.5rem}.list__item span{font-weight:600;width:35%}.list__item div{display:flex;align-items:center}.list__item .dot{width:.8rem;height:.8rem;border-radius:50%;margin-right:.4rem}.list__item .dot--active{background:#5fdba7 !important}.list__item .dot--inactive{background:#f44336 !important}.list__disc{width:1rem;height:1rem;color:#455A64;margin-right:.2rem}@media (min-width: 620px){.main-grid{grid-template-columns:1fr 1fr}}@media (min-width: 768px){html,body{font-size:98%}.main-grid{grid-template-columns:1fr 1fr 1fr 1fr}.card{margin-right:0 !important}}
</style>
<div class="sparkline8-graph dashone-comment dashtwo-messages">
    <div class="comment-phara">
        <div class="row comment-adminpr">
            <?php
                if($user->currency == 'N')
                {
                    $invs = App\packages::where('id', '!=', 3)->orderby('id', 'asc')->get();
                }
                elseif($user->currency == '$')
                {
                    $invs = App\packages::where('id', 3)->orderby('id','asc')->get();
                }

            ?>
            @if(isset($invs) && count($invs) > 0)
                @foreach($invs as $inv)

                    @php
                        echo($inv);
                    @endphp

                    {{-- <div class="col-sm-4">
                        {{-- <div class="panel card pack-container" style="" align="center">
                            <div class="panel-head" style="padding:15px; background-color: #069; border-bottom: 1px solid #CCC;">
                                <h3 class="txt_transform">{{$inv->package_name}} Package</h3>
                            </div>
                            <div class="" align="center" >
                                <br>
                                    <h4 class="txt_transform" style="text-transform: uppercase;">
                                        <strong>Period of Investment</strong>
                                    </h4>
                                    <div style="font-size: 20px;"><b>56{{$inv->period}}</b></div>
                                    <span class="">Working Days</span>
                            </div>
                            <span align="center">..............................</span>
                            <div class="" align="center" style="">
                                    <h4 class="txt_transform" style="text-transform: uppercase;">
                                        <strong>Min Investment</strong>
                                    </h4>
                                    <span class="pk_num">{{$user->currency}} {{$inv->min}}</span>
                                    <h4 class="txt_transform" style="text-transform: uppercase;">
                                        <strong>Max Investment</strong>
                                    </h4>
                                    <span class="pk_num">{{$user->currency}} {{$inv->max}}</span>
                            </div>                                                    
                            
                            <span align="center">..............................</span>
                            <div class="" align="center">
                                    <h4 class="txt_transform">Daily Interest: {{$inv->daily_interest*100}}%</h4>
                                    <h4 class="txt_transform">Withdrawal Fee: {{$inv->withdrwal_fee*100}}%</h4>
                                    
                            </div>
                            <div class="" align="center">
                                    <a id="{{$inv->id}}" href="javascript:void(0)" class="btn btn-info" style="color:#FFF;" onclick="inv(this.id, '{{$inv->package_name}}', '{{$inv->period}}', '{{$inv->daily_interest}}', '{{$inv->min}}', '{{$inv->max}}', '{{$user->wallet}}')">
                                        Invest
                                    </a>
                                    <br><br>
                            </div>

                        </div> --}}
                    </div> --}}
                                                                      
                @endforeach
            @else
                <div class="alert alert-warning">
                    Please update your profile before you can invest.
                </div>
            @endif
        </div>
        
    </div>
    
</div>











                    