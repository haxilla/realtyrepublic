<div style="position:fixed;color:#223e94;
background:#ebedff;width:100%;top:0;">
   <div style="padding:10px 20px;">
      <div>
         <h5><b>{{$responseOverlayTitle}}</b></h5>
      </div>
      <div>
         <h6>{{$responseOverlaySubtitle}}</h6>
      </div>
   </div>
</div>
<div class="adminProfilePage">
   <div>
      @include('admin.includes.profileUploads')
   </div>
   <div class="alert alert-danger" 
   style="text-align:left;margin:0;display:none;">
   </div>
   <div style="background:#ebedff;padding:25px;">
      <form action="/admin/updateProfile" method="post"
      id="adminProfileForm">
         {{csrf_field()}}
         <div class="row" style="margin-bottom:10px;">
            <div class="col-6" style="padding:0 5px;">
               <label for="adminFirst">First</label>
               <input name="adminFirst" type="text" class="form-control"
               style="color:#000;"
               @if(old('agtFirst'))
                  value="{{old('adminFirst')}}"
               @else
                  value="{{$adminInfo['adminFirst']}}"
               @endif>
            </div>
            <div class="col-6" style="padding:0 5px;">
               <label for="adminLast">Last</label>
               <input name="adminLast" type="text" class="form-control"
               @if(old('agtFirst'))
                  value="{{old('agtLast')}}"
               @else
                  value="{{$adminInfo['adminLast']}}"
               @endif>
            </div>
         </div>
         <div class="row" style="margin-bottom:10px;">
            <div class="col-12" style="padding:0 5px;">
               <label for="adminPosition">Job Title</label>
               <input name="adminPosition" type="text" 
               class="form-control"
               @if(old('adminPosition'))
                  value="{{old('adminPosition')}}"
               @else
                  value="{{$adminInfo['adminPosition']}}"
               @endif>
            </div>
         </div>
         <div class="row" style="margin-bottom:10px;">
            <div class="col-6" style="padding:0 5px;">
               <label for="adminHandle">Handle</label>
               <input name="adminHandle" type="text" 
               class="form-control"
               @if(old('adminHandle'))
                  value="{{old('adminHandle')}}"
               @else
                  value="{{$adminInfo['adminHandle']}}"
               @endif>
            </div>
            <div class="col-6" style="padding:0 5px;">
               <label for="adminPhone">Phone</label>
               <input name="adminPhone" type="text" class="form-control"
               @if(old('adminPhone'))
                  value="{{old('adminPhone')}}"
               @else
                  value="{{$adminInfo->adminPhone}}"
               @endif>
            </div>
         </div>
         <div class="row" style="margin-bottom:10px;">
            <div class="col-12" style="padding:0 5px;">
               <label for="adminEmail">Email</label>
               <input name="adminEmail" type="text" class="form-control"
               @if(old('Email'))
                  value="{{old('adminEmail')}}"
               @else
                  value="{{$adminInfo['adminEmail']}}"
               @endif>
            </div>
         </div>
         <hr>
         <div style="text-align:center;width:100%;">
            <div>
               <input type="submit" 
               class="btn btn-default adminProfileSubmit"
               style="background:#223e94;color:#fff;border:3px solid #fff;
               border-radius:2em;padding:5px 15px;">
            </div>
         </div>
      </form>
   </div>
</div>
