<?php
use App\models\core\propphoto;

$uploadDir  = "hqphotos/$zipDir/$mlsDir";

$maxOrd=propphoto::where('propflyer_id','=',"$idFly")
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
      'propflyer_id' => $idFly
   ]);
}
