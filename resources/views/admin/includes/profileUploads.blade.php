<div class="photoLogoDiv">
   <div class="row" style="margin:0;
   padding-top:10px;padding-bottom:10px;">
      <div class="col-6">
         <div style="text-align:center;">
            <img src="images/admin/profilePhotos/{{$adminPhoto}}"
            class="adminPhotoDisplay" style="max-height:90px;">
         </div>
         <div style="padding:5px 0;text-align:center;"
         class="hasPhoto
         @if($adminPhoto=='noProfilePhoto3.jpg')
            displayNone
         @endif
         ">
            <a class="deletePhotoButton" href="#"
            style="color:#223e94;font-weight:bold;">
               Delete Photo
            </a>
         </div>
      </div>
      <div class="col-6">
         <div style="padding-bottom:15px;text-align:center;">
            <a class="adminPhotoButton" href="#"
            style="color:#223e94;font-weight:bold;">
               Add Photo
            </a>
         </div>
         <div style="padding-bottom:15px;text-align:center;">
            <a class="changeAdminUname" href="#"
            style="color:#223e94;font-weight:bold;">
               Change Username
            </a>
         </div>
         <div style="padding-bottom:15px;text-align:center;">
            <a class="changeAdminPassword" href="#"
            style="color:#223e94;font-weight:bold;">
               Change Password
            </a>
         </div>
      </div>
   </div>
</div>
<div class="addAdminPhotoDiv" style="background-color:#ebedff;
display:none;color:#223e94;margin:15px;padding:15px;border-radius:.25rem;
margin-top:5px;">
   <div>
      <div class="photoLogoFillDiv"
      style="float:left;font-weight:bold;padding:15px;padding-left:0;
      padding-top:0;">
         Choose Your Profile Photo
      </div>
      <div style="float:right;"
      class="photoCancelDiv">
         <a class="cancelPhotoLogo" href="#"
         style="font-size:.9em;color:#900;cursor:pointer;">
            Cancel
         </a>
      </div>
      <div style="clear:both;">
      </div>
   </div>
   <hr style="margin-top:0;">
   <div class="adminPhotoPreviewDiv" style="display:none;">
      <div class="row">
         <div class="col-sm-3" style="text-align:center;">
            <img src="#" class="adminPhotoPreview" alt="Profile Photo"
            style="max-height:90px;">
         </div>
         <div class="col-sm-6" style="margin-top:auto;margin-bottom:auto;
         text-align:center;">
            Use this image for your photo?
         </div>
         <div class="col-sm-3" style="margin-top:auto;margin-bottom:auto;">
            <div style="background:#0082cb;color:#fff;padding:5px;margin:5px;
            text-align:center;border-radius:2em;border:2px solid #fff;
            cursor:pointer;" class="photoUploadConfirm">
               Yes
            </div>
            <div style="background:#900;color:#fff;padding:5px;margin:5px;
            text-align:center;border-radius:2em;border:2px solid #fff;
            cursor:pointer;" class="cancelPhotoLogo">
               No
            </div>
         </div>
      </div>
   </div>
   <div class="adminPhotoDeleteDiv" style="display:none;">
      <div class="row">
         <div class="col-sm-3" style="text-align:center;">
            <img src="images/admin/profilePhotos/{{$adminPhoto}}" 
            style="max-height:90px;" 
            class="adminPhotoDisplay">
         </div>
         <div class="col-sm-6" style="margin-top:auto;margin-bottom:auto;
         color:#900;text-align:center;">
            <div>
               Are you <b>SURE</b> ?
            </div>
            <div>
               <b>DELETE</b> this photo
            </div>
         </div>
         <div class="col-sm-3" style="margin-top:auto;margin-bottom:auto;">
            <div style="background:#0082cb;color:#fff;padding:5px;margin:5px;
            text-align:center;border-radius:2em;border:2px solid #fff;
            cursor:pointer;" class="photoDeleteConfirm">
               Yes
            </div>
            <div style="background:#900;color:#fff;padding:5px;margin:5px;
            text-align:center;border-radius:2em;border:2px solid #fff;
            cursor:pointer;" class="cancelPhotoLogo">
               No
            </div>
         </div>
      </div>
   </div>
   <div class="profileImageLoading"
   style="padding:15px;margin:15px;text-align:center;display:none;">
      <div style="display:inline-block;">
         <img src="/images/largeLoader.gif" style="max-height:35px;">
      </div>
      <div style="display:inline-block">
         LOADING ... PLEASE WAIT!
      </div>
   </div>
   <div class="adminPhotoFormDiv">
      <form id="adminPhotoForm" enctype="multipart/form-data"
      method="post" style="padding:15px;padding-top:0">
         {{csrf_field()}}
         <div style="display:inline-block;">
            <input type="file"
            name="file" id="adminPhotoChoice"
            style="background-color:#fff;border-radius:.25rem;
            color:#000;padding:.375rem;">
         </div>
      </form>
   </div>
</div>


