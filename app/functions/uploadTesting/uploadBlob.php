<?php
if(isset($_FILES)){
   //tmp_name
   $temp=$_FILES['fileSelect']['tmp_name'];
   //original name
   $oName=$_FILES['fileSelect']['name'];
   //get extension
   $getExt = new SplFileInfo($oName);
   $ext=$getExt->getExtension();
   //assign new filename
   $newFile=md5_file($temp).time().'.'.$ext;
   //move and report status
   if(move_uploaded_file($temp,"uploadTest/$newFile")){
      //set path
      $target_path="uploadTest/$newFile";
      //set permissions
      chmod($target_path, 0750);
      //set status
      $upload_status="$oName Uploaded Successfully!";
      //insert into database
   }
}else{
   alert('failed');
   //$upload_status="$oName Upload Failed!";
}

