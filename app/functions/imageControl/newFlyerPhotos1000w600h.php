<?php
//get model
use App\models\core\propphoto;

//   ***   THIS FILE LOCATION WAS CHANGED  //
//   ***   CURRENTLY IN USE AT
//   ***   synch/photoW1000/functions/flyerPhotos1000w600h

//  This does not interact with old server like other file above does

//if tall resize to 300height otherwise 300wide
if($t->orient==='tall'){
   $resize_h='600';
   if($t->ratio==0){
      $targetWidth=$resize_h*$ratio;
   }else{
      $targetWidth=$resize_h*$t->ratio;}
   //set variables   
   $resize_w=round($targetWidth);
   $filePrefix='h600';
   //echo "<BR>ORIENT: $orient - H: $newHeight X W: $targetWidth<BR>";
}else{
   $resize_w='1000';
   if($t->ratio==0){
      $targetHeight=$resize_w/$ratio;
   }else{
      $targetHeight=$resize_w/$t->ratio;}
   //set variables
   $resize_h=round($targetHeight);
   $filePrefix='w1000';
   //echo "<BR>ORIENT: $orient - W: $newWidth X H: $targetHeight<BR>";
}

//set variables for photo resizing
$photoPath     = "hqphotos/$zipDir/$mlsDir/$t->photoName";
$file          = $photoPath;
$resizedName   = "$filePrefix-$t->photoName";
$resizedLoc    = "hqphotos/$zipDir/$mlsDir/$resizedName";
//if greater than 600 tall or wider than 1000
if(($t->orient==='tall' && $t->height>=600)
||($t->orient==='wide' && $t->width>=1000)){
   //call the function (when passing path to pic)
   smart_resize_image($file ,null, $resize_w, $resize_h, false, $resizedLoc, false, false, 90 );
   //re-assign the name and resized values
   $newFileName=$resizedName;
   $newFileSize=filesize($resizedLoc);
   $resized=1000;
   //add dimension values of original - gets width/height
   list($width, $height) = getimagesize($resizedLoc);
   //get new dimensions & add values
   $ratio=$width/$height;
   $ratio=round($ratio,4);
   //insert into database
   propphoto::create([
      'resized'      => $resized,
      'resize_w'     => $resize_w,
      'resize_h'     => $resize_h,
      'width'        => $width,
      'height'       => $height,
      'ratio'        => $ratio,
      'photoName'    => $newFileName,
      'newFileSize'  => $newFileSize,
      'oldFileName'  => $t->photoName,
      'oldFileSize'  => $t->oldFileSize,
      'orient'       => $t->orient,
      'propflyer_id' => $idFly,
      'propagent_id' => $umid,
      'ord'          => $t->ord,
      'def'          => $t->def
   ]);
}

if($t->orient==='wide' && $t->width>=850){
   //just copy photo with new name
   copy($file, $resizedLoc);
   //re-assign the name and resized values
   $newFileName=$resizedName;
   $newFileSize=filesize($resizedLoc);
   $resized=1000;
   //add dimension values of original - gets width/height
   list($width, $height) = getimagesize($resizedLoc);
   //get new dimensions & add values
   $ratio=$width/$height;
   $ratio=round($ratio,4);
   //insert into database
   propphoto::create([
      'resized'      => $resized,
      'resize_w'     => $resize_w,
      'resize_h'     => $resize_h,
      'width'        => $width,
      'height'       => $height,
      'ratio'        => $ratio,
      'photoName'    => $newFileName,
      'newFileSize'  => $newFileSize,
      'oldFileName'  => $t->photoName,
      'oldFileSize'  => $t->oldFileSize,
      'orient'       => $t->orient,
      'propflyer_id' => $idFly,
      'propagent_id' => $umid,
      'ord'          => $t->ord,
      'def'          => $t->def
   ]);
}



