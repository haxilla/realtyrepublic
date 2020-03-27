<div style="border:1px solid #ccc;">
   @if($errors->any())
      <div class="alert alert-warning" style="margin:25px;text-align:left;">
         <ul style="padding:0;margin:0;padding-left:1.5em;">
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
   @endif
   <div style="background:#223e94;padding:25px;">
      <h6 style="color:#fff;margin:0;padding:0;">
         Review the information Below & Complete Your Purchase
      </h6>
   </div>
   <div style="padding:15px;border:1px solid #ccc;margin:15px;">
      <a href="/mdbx/newTrialRequest?shortKey={{$shortKey}}&p={{$p}}">
         EDIT INFO
      </a>
   </div>
   <div style="padding:25px;background:#ebedff;">
      <div class="row" style="margin-bottom:5px;">
         <div class="col-12" style="padding:0 5px;">
            <div>
               {{$theAgent['agtFirst']}} {{$theAgent['agtLast']}} {{$theAgent['agtDesigs']}}
            </div>
         </div>
      </div>
      <div class="row" style="margin-bottom:5px;">
         <div class="col-12" style="padding:0 5px;">
            <div>
               {{$theAgent['officeName']}}
            </div>
         </div>
      </div>
      <div class="row" style="margin-bottom:5px;">
         <div class="col-12" style="padding:0 5px;">
            {{$theAgent['officeAddress1']}}
         </div>
      </div>
      <div class="row" style="margin-bottom:5px;">
         <div class="col-12" style="padding:0 5px;">
            <div>
               {{$theAgent['officeCity']}}, {{$theAgent['officeState']}} {{$theAgent['officeZip']}}
            </div>
         </div>
      </div>
      <hr>
      <div class="row" style="margin-bottom:5px;">
         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            Your Phone
         </div>
         <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
            <div>
               {{$theAgent['agtMainPhone']}}
            </div>
         </div>
      </div>
      <div class="row" style="margin-bottom:5px;">
         <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
            Your Email
         </div>
         <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
            <div>
               {{$theAgent['agtEmail']}}
            </div>
         </div>
      </div>
      @if($theAgent['agtWebsite'])
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Your Website
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <div>
                  {{$theAgent['agtWebsite']}}
               </div>
            </div>   
         </div>
      @endif
      <hr>
      <div>
         @if($theAgent['amt']=='20')
            @if($paymentMode !== 'LIVE')
               @include('mdbxPublic.includes.paypal.button20sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button20sk')
            @endif
         @elseif($theAgent['amt']=='40')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button40sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button40sk')
            @endif
         @elseif($theAgent['amt']=='60')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button60sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button60sk')
            @endif
         @elseif($theAgent['amt']=='99')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button99sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button99sk')
            @endif
         @elseif($theAgent['amt']=='100')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button100sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button100sk')
            @endif
         @elseif($theAgent['amt']=='120')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button120sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button120sk')
            @endif
         @elseif($theAgent['amt']=='135')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button135sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button135sk')
            @endif
         @elseif($theAgent['amt']=='160')
            @if($paymentMode!=='LIVE')
               @include('mdbxPublic.includes.paypal.button160sk_test')
            @else
               @include('mdbxPublic.includes.paypal.button160sk')
            @endif
         @else
            <div>
               Sorry there is an issue with your request
            </div>
            <div>
               Please Contact us directly with error message
            </div>
            <div>
               error-Line107-public/includes/forms/trialAgentDisplay
            </div>
         @endif
      </div>
   </div>
</div>
