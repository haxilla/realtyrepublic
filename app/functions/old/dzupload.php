<?php

use App\propphoto;
use App\propmeta;

$umid=Auth::user()->id;

$propMetas=propmeta::select('zipDir','mlsDir','sysID')
->where('propflyer_id','=',"$id")
->where('propagent_id','=',"$umid")
->first();

if(!$propMetas){
   dd('error processing record');
}

$zipDir     = $propMetas['zipDir'];
$mlsDir     = $propMetas['mlsDir'];
$sysID      = $propMetas['sysID'];
$uploadDir  = "hqphotos/$zipDir/$mlsDir";

$maxOrd=propphoto::where('propflyer_id','=',"$id")
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
   $filename = time().'-'.$id.$umid.$_FILES['file']['name'];
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

   $thisFile=time().'-'.$id.$umid.$_FILES['file']['name'];

   propphoto::create([
      'photoName'    => $thisFile,
      'oldFileName'  => $thisFile,
      'propflyer_id' => $id,
      'propagent_id' => $umid,
      'width'        => $width,
      'height'       => $height,
      'ratio'        => $ratio,
      'orient'       => $orient,
      'sysID'        => $sysID,
      'ord'          => $thisOrd,
      'def'          => $def,
      'oldFileSize'  => $oldFileSize
   ]);

}
