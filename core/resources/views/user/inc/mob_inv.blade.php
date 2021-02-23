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
    </div>

    <div class="row" style="">
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
<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,700&display=swap");*{margin:0;padding:0;box-sizing:border-box;list-style-type:none;text-decoration:none;transition:all 0.1s 0s ease}html,body{font-family:'Roboto', sans-serif}.divider{width:100%;border-top:1px solid #BDBDBD}.flex-card{border-radius:1rem;min-height:280px;padding:1rem;margin-bottom:1rem;display:flex;flex-direction:column;box-shadow:0 6px 15px rgba(33,33,33,0.2)}.flex-card__header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem}.flex-card__section{display:flex;align-items:center}.flex-card__section .group{margin-left:1rem}.flex-card__title{display:flex;align-items:flex-start;font-size:.8rem;color:#474747}.flex-card__title span{font-size:1.5rem;font-weight:bold;color:#141414}.flex-card__media,.flex-card__media--rush,.flex-card__media--gold,.flex-card__media--brown,.flex-card__media--grey,.flex-card__media--master{position:relative;width:3.5rem;height:3.5rem;border-radius:0.5rem;background:#098853;overflow:hidden;box-shadow:0 4px 8px rgba(0,0,0,0.2)}.flex-card__media::before,.flex-card__media--rush::before,.flex-card__media--gold::before,.flex-card__media--brown::before,.flex-card__media--grey::before,.flex-card__media--master::before{content:"";height:1.75rem;width:1.75rem;background:#0ed07f;border-radius:50%;position:absolute;right:-1px;top:-5%;transform:translateY(5%)}.flex-card__media::after,.flex-card__media--rush::after,.flex-card__media--gold::after,.flex-card__media--brown::after,.flex-card__media--grey::after,.flex-card__media--master::after{content:"";width:1.75rem;height:1.4rem;background:#0ed07f;position:absolute;bottom:0}.flex-card__media--rush{background:#FFA000 !important}.flex-card__media--rush::before{background:#ffb333 !important}.flex-card__media--rush::after{background:#ffb333 !important}.flex-card__media--gold{background:#ccac00 !important}.flex-card__media--gold::before{background:#ffdb1a !important}.flex-card__media--gold::after{background:#ffdb1a !important}.flex-card__media--brown{background:#de6f43 !important}.flex-card__media--brown::before{background:#e6906e !important}.flex-card__media--brown::after{background:#e6906e !important}.flex-card__media--grey{background:#607D8B !important}.flex-card__media--grey::before{background:#7b96a3 !important}.flex-card__media--grey::after{background:#7b96a3 !important}.flex-card__media--master{background:#C2185B !important}.flex-card__media--master::before{background:#e42973 !important}.flex-card__media--master::after{background:#e42973 !important}.flex-card__chip{text-transform:uppercase;font-size:.6rem;font-weight:600;color:#fff;letter-spacing:1pt;background:#0e098b;padding:.4rem .6rem;border-radius:1rem;position:relative;overflow:hidden}.flex-card__chip::before{content:"";width:100%;height:100%;background:rgba(16,11,163,0.23);border-radius:50%;position:absolute}.flex-card__body{padding:1rem 0}.flex-card__footer{display:flex}.flex-card__footer .btn{display:flex;align-items:center;justify-content:space-between;width:100%;border:none;outline:none;border-radius:.3rem;padding:.6rem 1rem;background:#100ba3;color:#fff;font-weight:600;cursor:pointer;box-shadow:0 4px 8px rgba(0,0,0,0.2)}.flex-card__footer .btn__icon{width:1.2rem;height:1.2rem}.flex-card__footer .btn:hover{transform:scale(1.01);background:#5a3e19}.list__item{display:flex;justify-content:space-between;font-size:.95rem;font-weight:500;color:#212121;text-transform:capitalize}.list__item:not(:last-child){margin-bottom:.5rem}.list__item span{font-weight:600;width:35%}.list__item div{display:flex;align-items:center}.list__item .dot{width:.8rem;height:.8rem;border-radius:50%;margin-right:.4rem}.list__item .dot--active{background:#5fdba7 !important}.list__item .dot--inactive{background:#f44336 !important}.list__disc{width:1rem;height:1rem;color:#455A64;margin-right:.2rem}
    /*# sourceMappingURL=test.min.css.map */
</style>

<div class="row">
    <div class="col col-sm-12 col-md-6 col-lg-4">
        <div class="flex-card">
            <div class="flex-card__header">
            <div class="flex-card__section">
                <div class="flex-card__media"></div>

                <div class="group">
                <h2 class="flex-card__heading">Gold</h2>
                
                <h4 class="flex-card__title">$<span>30</span>
                </h4>
                </div>
            </div>
            
            <div class="flex-card__chip">package</div>
            </div>
            
            <div class="divider"></div>
            
            <div class="flex-card__body">
            <ul class="list">
                <li class="list__item">
                <div>
                    <svg class="list__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    Return
                </div>

                <span>$324.00</span>
                </li>
                <li class="list__item">
                <div>
                    <svg class="list__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                    Ending
                </div>
                <span>29 Feb, 2021</span>
                </li>
                
                <li class="list__item">
                <div>
                    <svg class="list__disc" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    Days spent
                </div>
                <span>10</span>
                </li>
                
                <li class="list__item">
                <div>
                    <div class="dot dot--active"></div>
                    Status
                </div>
                
                <span>Active</span>
                </li>
                
            </ul>
            </div>
            
            <div class="flex-card__footer">
            <button class="btn tooltip">
                $ 122.0000
                <svg class="btn__icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
            </button>
            </div>
        </div>
    </div>
</div>
