<?php

use App\models\core\propphoto;
use App\models\core\propagent;
use App\models\core\propmeta;
use App\models\core\tempflyer;
use App\models\smartyStreets\veraddress;

$umid=Auth::guard('member')->user()->id;
$id=request('id');

if(!$id || !$umid){
   dd('error-line13-appPath/members/functions/addFlyerPhotos');}

//metacheck
$metaCheck=propmeta::where('sk1','=',"$id")
->select('propflyer_id','zipDir','mlsDir')
->first();

//if none found, create
if(!$metaCheck){
   dd('error-line24 /members/functions/addFlyerPhotos');}

$zipDir=$metaCheck['zipDir'];
$mlsDir=$metaCheck['mlsDir'];
$propflyer_id=$metaCheck['propflyer_id'];

//set upload Dir
$uploadDir  = "hqphotos/$zipDir/$mlsDir";
//query propphotos
$maxOrd1=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('propagent_id','=',"$umid")
->where('resized','=','1')
->max('ord');
$maxOrd500=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('propagent_id','=',"$umid")
->where('resized','=','500')
->max('ord');
$maxOrd1000=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('propagent_id','=',"$umid")
->where('resized','=','1000')
->max('ord');

//check ord1
if(!$maxOrd1){
   $thisOrd1=1;
   $def1=1;
}else{
   $thisOrd1=$maxOrd1+1;
   $def1=0;}
//check ord500
if(!$maxOrd500){
   $thisOrd500=1;
   $def500=1;
}else{
   $thisOrd500=$maxOrd500+1;
   $def500=0;}
//check ord1000
if(!$maxOrd1000){
   $thisOrd1000=1;
   $def1000=1;
}else{
   $thisOrd1000=$maxOrd1000+1;
   $def1000=0;}

//if directory doesnt exist create it
if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
  mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}

if (!empty($_FILES) && !empty($_POST)) {
   $tmpFile  = $_FILES['fileSelect']['tmp_name'];
   $newFileName = $_FILES['fileSelect']['name'];
   $originalName = $propflyer_id.$umid.$_POST['originalName'];
   //get extension
   $ext = pathinfo($newFileName, PATHINFO_EXTENSION);
   $filename      = uniqid().'-'.$umid.'.'.$ext;
   $moveFileName  = uniqid().'-'.$umid.'.'.$ext;
   $filepath      = $uploadDir.'/'.$filename;
   $moveFilepath  = $uploadDir.'/'.$moveFileName;
   $thisFile      = $filename;
   //open resize variable
   $resizeOK=null;
   //move file
   move_uploaded_file($tmpFile,$filepath);
   //set variables per photo size
   //if 1
   if(strpos($newFileName,'o-')!==false){
      $resizeOK=1;
      $thisOrd=$thisOrd1;
      $def=$def1;}
   //if 500
   if(strpos($newFileName,'w500-')!==false ){
      $resizeOK=500;
      $thisOrd=$thisOrd500;
      $def=$def500;}
   // if 1000
   if(strpos($newFileName,'w1000-')!==false){
      $resizeOK=1000;
      $thisOrd=$thisOrd1000;
      $def=$def1000;}

   //otherwise error
   if(!$resizeOK){
      dd('error-line107-newPhotoUpload.php');}

   //add dimension values of original - gets width/height
   list($width, $height) = getimagesize($filepath);

   //get new dimensions & add values
   $ratio=$width/$height;
   $ratio=round($ratio,4);
   $oldFileSize=filesize($filepath);

   if($width > $height){
      $orient='wide';
   }else{
      $orient='tall';}

   //if resized include a resized=1 for original
   if($resizeOK=='1000'){
      $thisOrd=$maxOrd1+1;
      copy($filepath,$moveFilepath);
      propphoto::create([
         'photoName'    => $moveFileName,
         'oldFileName'  => $originalName,
         'ord'          => $thisOrd,
         'def'          => $def,
         'propagent_id' => $umid,
         'resized'      => 1,
         'width'        => $width,
         'height'       => $height,
         'ratio'        => $ratio,
         'orient'       => $orient,
         'oldFileSize'  => $oldFileSize,
         'propflyer_id' => $propflyer_id
      ]);
   }

   propphoto::create([
      'photoName'    => $thisFile,
      'oldFileName'  => $originalName,
      'ord'          => $thisOrd,
      'def'          => $def,
      'propagent_id' => $umid,
      'resized'      => $resizeOK,
      'width'        => $width,
      'height'       => $height,
      'ratio'        => $ratio,
      'orient'       => $orient,
      'oldFileSize'  => $oldFileSize,
      'propflyer_id' => $propflyer_id
   ]);
}
