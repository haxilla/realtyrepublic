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
   <div style="padding:25px;background:#ebedff;">
      <form action="/mdbx/newTrialRequestPost" method="post">
         {{csrf_field()}}
         <div class="row" style="margin-bottom:5px;">
            <div class="col-4" style="padding:0 5px;">
               <input name="agtFirst" type="text" class="form-control"
               placeholder="First Name"
               value="{{ old('agtFirst') }}">
            </div>
            <div class="col-4" style="padding:0 5px;">
               <input name="agtLast" type="text" class="form-control"
               placeholder="Last Name"
               value="{{ old('agtLast') }}">
            </div>
            <div class="col-4" style="padding:0 5px;">
               <input name="agtDesigs" type="text" class="form-control"
               placeholder="Designations (ie. ABR,CRS,GRI)"
               value="{{ old('agtDesigs') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-12" style="padding:0 5px;">
               <input name="officeName" type="text" class="form-control"
               placeholder="Office Name"
               value="{{ old('officeName') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-12" style="padding:0 5px;">
               <input name="officeAddress1" type="text" class="form-control"
               placeholder="Office Address"
               value="{{ old('officeAddress1') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-6" style="padding:0 5px;">
               <input name="officeCity" type="text" class="form-control"
               placeholder="City"
               value="{{ old('officeCity') }}">
            </div>
            <div class="col-3" style="padding:0 5px;">
               <input name="officeState" type="text" class="form-control"
               placeholder="State"
               value="{{ old('officeState') }}">
            </div>
            <div class="col-3" style="padding:0 5px;">
               <input name="officeZip" type="text" class="form-control"
               placeholder="Zip"
               value="{{ old('officeZip') }}">
            </div>
         </div>
         <hr>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Your Phone
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtMainPhone" type="text" class="form-control"
               value="{{ old('agtMainPhone') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Your Email
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtEmail" type="text" class="form-control"
               value="{{$theEmail}}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Your Website
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtWebsite" type="text" class="form-control"
               value="{{ old('agtWebsite') }}">
            </div>
         </div>

         <hr>
         <div style="text-align:center;width:100%;">
            <div class="g-recaptcha"
            data-sitekey="6LfSH4kUAAAAADvUZitB5GPueUtXiSL0SBZKcCPR"
            style="display:inline-block;">
            </div>
            <div>
               <input type="submit" class="btn btn-default"
               style="background:#223e94;color:#fff;border:3px solid #fff;
               border-radius:2em;padding:10px 20px;">
               <input name="key" type="hidden" value="{{$key}}">
               <input name="amt" type="hidden" value="{{$amt}}">
               <input name="purchaseDesc" type="hidden" value="{{$purchaseDesc}}">
            </div>
         </div>
      </form>
   </div>
</div>
