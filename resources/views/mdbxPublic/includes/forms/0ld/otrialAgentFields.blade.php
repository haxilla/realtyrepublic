<div>
   <h3 style="color:#223e94;margin:0;padding:0;text-align:left;
   margin-bottom:15px;">
      @if($p==1)
         Let's start with the basics!
      @else
         Setup your Trial Account!
      @endif
   </h3>
</div>
<div style="border:1px solid #223e94;">
   @if($errors->any())
      <div class="alert alert-warning" style="margin:25px;text-align:left;">
         <ul style="padding:0;margin:0;padding-left:1.5em;">
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
   @endif
   @if(session('message'))
      <?php
         // code to change color
         // based on message contents
         $searchString='COMMA';
         $thisMessage=session('message');
      ?>
      <div
      @if(strpos($thisMessage, $searchString) !== false)
         class="alert alert-danger"
      @else
         class="alert alert-success"
      @endif
      style="margin:0;margin-bottom:15px;">
         {{ session('message') }}
      </div>
   @endif
   <div style="padding:25px;">
      <form action="/mdbx/newTrialRequestPost" method="post">
         {{csrf_field()}}
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               First Name
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtFirst" type="text" class="form-control"
               value="{{ old('agtFirst') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Last Name
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtLast" type="text" class="form-control"
               value="{{ old('agtLast') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Designations
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="agtDesigs" type="text" class="form-control"
               value="{{ old('agtDesigs') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Office Name
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="officeName" type="text" class="form-control"
               value="{{ old('officeName') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Office Address
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="officeAddress1" type="text" class="form-control"
               value="{{ old('officeAddress1') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               City
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="officeCity" type="text" class="form-control"
               value="{{ old('officeCity') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               State
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="officeState" type="text" class="form-control"
               value="{{ old('officeState') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Zip
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <input name="officeZip" type="text" class="form-control"
               value="{{ old('officeZip') }}">
            </div>
         </div>
         <div class="row" style="margin-bottom:5px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
               Main Phone
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
         <div>
            <input type="submit" class="btn btn-default">
            <input name="key" type="hidden" value="{{$key}}">
            <input name="amt" type="hidden" value="{{$amt}}">
         </div>
      </form>
   </div>
</div>
