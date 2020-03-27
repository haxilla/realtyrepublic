<?php
//get model to insert later
Use App\models\core\propphoto;

//if tall resize to 300height otherwise 300wide
if($t->orient==='tall'){
   $resize_h='300';
   $targetWidth=$resize_h*$t->ratio;
   $resize_w=round($targetWidth);
   $filePrefix='h300';
   //echo "<BR>ORIENT: $orient - H: $newHeight X W: $targetWidth<BR>";
}else{
   $resize_w='500';
   $targetHeight=$resize_w/$t->ratio;
   $resize_h=round($targetHeight);
   $filePrefix='w500';
   //echo "<BR>ORIENT: $orient - W: $newWidth X H: $targetHeight<BR>";
}
//set variables for photo resizing
$photoPath     = "hqphotos/$zipDir/$mlsDir/$t->photoName";
$file          = $photoPath;
$resizedName   = "$filePrefix-$t->photoName";
$resizedLoc    = "hqphotos/$zipDir/$mlsDir/$resizedName";

if($t->width>=500){
   //if larger than 500 resize - call the function (when passing path to pic)
   smart_resize_image($file ,null, $resize_w, $resize_h, false, $resizedLoc, false, false, 100);
}else{
   //just copy photo with new name
   copy($file, $resizedLoc);}

//re-assign the name and resized values
$newFileName=$resizedName;
$newFileSize=filesize($resizedLoc);
$resized=500;

//add dimension values of original - gets width/height
list($width, $height) = getimagesize($resizedLoc);

//get new dimensions & add values
$ratio=$width/$height;
$ratio=round($ratio,4);
//create new record
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
