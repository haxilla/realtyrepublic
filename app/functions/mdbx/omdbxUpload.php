<?php

use App\propphoto;
use App\tempflyer;

$umid=Auth::user()->id;
$mdbxid=request('mdbxid');

$tempflyer=tempflyer::where('mdbxid','=',"$mdbxid")
->where('propagent_id','=',"$umid")
->first();

$DPB           = $tempflyer['DPB'];
$uFullStreet   = $tempflyer['tempFullStreet'];
$uCity         = $tempflyer['tempCity'];
$uState        = $tempflyer['tempState'];
$xZip          = $tempflyer['tempZip'];
$xMlsNum       = $tempflyer['tempMlsNum'];
$xUnitNum      = $tempflyer['tempUnitNum'];
$propflyer_id  = $tempflyer['propflyer_id'];
$xSysID        = $tempflyer['xSysID'];
$zipDir        = $tempflyer['tempZip'];
$mlsDir        = $tempflyer['tempMlsNum'];

if(!$mlsDir){
   $mlsDir=$xSysID;
}
if(!$zipDir || !$mlsDir){
   dd('error-line29-mdbxUpload.php');
}

if(!$xSysID || !$propflyer_id){
   //generate keys
   include('mdbxFlyerKeys.php');
   //update keys
   if($DPB=='none'){
      //generates $newID
      include('mdbxInsertManual.php');
   }else{
      //generates $newID
      include('mdbxInsertVerified.php');
   }
   //update with new value
   tempflyer::where('mdbxid','=',"$mdbxid")
   ->where('propagent_id','=',"$umid")
   ->update([
      'xSysID'       => $xSysID,
      'propflyer_id' => $newID
   ]);
}

$zipDir     = $tempflyer['tempZip'];
$mlsDir     = $tempflyer['tempMlsNum'];
$newID      = $tempflyer['propflyer_id'];
$uploadDir  = "hqphotos/$zipDir/$mlsDir";

$maxOrd=propphoto::where('propflyer_id','=',"$newID")
->where('propagent_id','=',"$umid")
->max('ord');

if(!$maxOrd){
   $thisOrd=1;
   $def=1;
}else{
   $thisOrd=$maxOrd+1;
   $def=0;
}

//if directory doesnt exist create it
if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
  mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);
}

if (!empty($_FILES)) {

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
      $orient='tall';
   }

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
