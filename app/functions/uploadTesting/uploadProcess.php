<?php
//json reply
header('Content-Type: application/json');
//set arrays
$uploaded=[];
$allowed=['jpg','jpeg','gif','png'];
//file arrays
$succeeded=[];
$failed=[];
//if present
if(!empty($_FILES['fileBrowse'])){
   foreach($_FILES['fileBrowse']['name'] as $key=>$name){
      //get temp file name
      $temp=$_FILES['fileBrowse']['tmp_name'][$key];
      //get extension
      $ext=explode('.',$name);
      //set extension
      $ext=strtolower(end($ext));
      //
      $newFile=md5_file($temp).time().'.'.$ext;
      //check if allowed
      if(in_array($ext,$allowed) === true &&
      move_uploaded_file($temp,"uploadTest/$newFile") === true){
         $succeeded[]=array(
            'name'=>$name,
            'newFile'=>$newFile
         );
      }else{
         $failed[]=array(
            'name'=>$name
         );
      }
   }

   if(!empty($_POST['ajax'])){
      echo json_encode(array(
         'succeeded' => $succeeded,
         'failed'    => $failed
      ));
   }
}
