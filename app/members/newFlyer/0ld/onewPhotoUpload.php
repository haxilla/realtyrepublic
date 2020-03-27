<?php

use App\models\core\propphoto;
use App\models\core\propagent;
use App\models\core\propmeta;
use App\models\core\tempflyer;
use App\models\smartyStreets\veraddress;

$umid=Auth::user()->id;
$mdbxid=request('mdbxid');

if(!$mdbxid || !$umid){
   dd('error-line11-appPath/members/newFlyer/newPhotoUpload');}

//set variables
include(app_path().'/members/newFlyer/tempFlyerVariables.php');
//metacheck
$metaCheck=propmeta::where('mdbxid','=',"$mdbxid")
->select('propflyer_id','xSysID')
->first();
//if there - set ID
if($metaCheck){
   //set newID
   $newID=$metaCheck['propflyer_id'];
   //set xSysID
   if(!$xSysID){
      //reset xSysID
      $xSysID=$metaCheck['xSysID'];
      //update tempflyer
      tempflyer::where('mdbxid','=',"$mdbxid")
      ->update([
         'xSysID'=>$xSysID,
      ]);}}

//if none found, create
if(!$metaCheck){
   //generate keys & new xSysID
   include(app_path().'/members/keygens/mdbxFlyerKeys.php');
   //update keys
   if($DPB=='none'){
      //manual creation
      include('mdbxInsertManual.php');
   }else{
      //verified creation
      include('mdbxInsertVerified.php');}

   tempflyer::where('mdbxid','=',"$mdbxid")
   ->where('propagent_id','=',"$umid")
   ->update([
      'xSysID'       => $xSysID,
      'propflyer_id' => $newID,
   ]);}

//set mlsDir
$mlsDir=$xZip;
//if none - set as xSysID
if(!$mlsDir){
   $mlsDir=$xSysID;}
//if still none - error
if(!$mlsDir){
   dd('error-line61-newPhotoUpload');}

//update meta
propmeta::where('propflyer_id','=',"$newID")
->update([
   'zipDir'=>$zipDir,
   'mlsDir'=>$mlsDir,]);

//set upload Dir
$uploadDir  = "hqphotos/$zipDir/$mlsDir";
//query propphotos
$maxOrd=propphoto::where('propflyer_id','=',"$newID")
->where('propagent_id','=',"$umid")
->max('ord');
//check ord
if(!$maxOrd){
   $thisOrd=1;
   $def=1;
}else{
   $thisOrd=$maxOrd+1;
   $def=0;}

//if directory doesnt exist create it
if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
  mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}

if (!empty($_FILES)) {

   print_r($_FILES);

   $tmpFile  = $_FILES['file']['tmp_name'];
   $getExt = $_FILES['file']['name'];
   $ext = pathinfo($getExt, PATHINFO_EXTENSION);
   $filename = uniqid().'-'.$umid.'.'.$ext;
   $filepath = $uploadDir.'/'.$filename;
   move_uploaded_file($tmpFile,$filepath);

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
      'oldFileName'  => $thisFile,
      'ord'          => $thisOrd,
      'def'          => $def,
      'propagent_id' => $umid,
      'width'        => $width,
      'height'       => $height,
      'ratio'        => $ratio,
      'orient'       => $orient,
      'oldFileSize'  => $oldFileSize,
      'propflyer_id' => $newID
   ]);
}
