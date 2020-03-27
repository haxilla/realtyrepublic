<?php

use App\models\core\propphoto;
use App\models\core\propagent;
use App\models\core\propmeta;
use App\models\core\tempflyer;
use App\models\smartyStreets\veraddress;

$umid=Auth::user()->id;
$id=request('id');

if(!$id || !$umid){
   dd('error-line13-appPath/members/functions/addFlyerPhotos');}

//metacheck
$metaCheck=propmeta::where('sk1','=',"$id")
->select('propflyer_id','zipDir','mlsDir')
->first();

//if none found, create
if(!$metaCheck){
   dd('error-line24-app/members/functions/addFlyerPhotos');}

$zipDir=$metaCheck['zipDir'];
$mlsDir=$metaCheck['mlsDir'];
$propflyer_id=$metaCheck['propflyer_id'];

//set upload Dir
$uploadDir  = "hqphotos/$zipDir/$mlsDir";
//query propphotos
$maxOrd500=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('propagent_id','=',"$umid")
->where('resized','=','500')
->max('ord');
$maxOrd1000=propphoto::where('propflyer_id','=',"$propflyer_id")
->where('propagent_id','=',"$umid")
->where('resized','=','1000')
->max('ord');

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
   $filename = uniqid().'-'.$umid.'.'.$ext;
   $filepath = $uploadDir.'/'.$filename;
   //open resize variable
   $resizeOK=null;
   //move file
   move_uploaded_file($tmpFile,$filepath);
   //set variables per photo size
   //if 500
   if(strpos($newFileName,'w500-')!==false ){
      $resizeOK=500;
      $thisOrd=$thisOrd500;
      $def=$def500;}
   //if 1000
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

   $thisFile=$filename;

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
