<?php
//get model
use App\models\core\propphoto;
use App\models\oldsite\oldPhoto;

//   ***   YOU ARE IN A LOOP      ***   //
//   ***   Current Record is $t   ***   //

//assigns width/height/ratio/orient
include(app_path().'/synch/photoW1000/variables/photoLoopVariables.php');

//if tall resize to 300height otherwise 300wide
if($orient=='tall'){
   $resize_h='600';
   $targetWidth=$resize_h*$ratio;
   $resize_w=round($targetWidth);
   $filePrefix='h600';
   //echo "<BR>ORIENT: $orient - H: $newHeight X W: $targetWidth<BR>";
}else{
   $resize_w='1000';
   $targetHeight=$resize_w/$ratio;
   $resize_h=round($targetHeight);
   $filePrefix='w1000';}
   //echo "<BR>ORIENT: $orient - W: $newWidth X H: $targetHeight<BR>";

if(!$t->photoName){
   dd('error-line27-synch/functions/flyerPhotos1000w600h');}

//set variables for photo resizing
$photoPath     = "hqphotos/$zipDir/$mlsDir/$t->photoName";
$file          = $photoPath;
$resizedName   = "$filePrefix-$t->photoName";
$resizedLoc    = "hqphotos/$zipDir/$mlsDir/$resizedName";

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
   'def'          => $t->def,
   'existCheck'   => \Carbon\Carbon::now(),
]);

//update as resized
propphoto::where('photoID','=',"$t->photoID")
->update([
   'resized'     =>1,
   'existCheck'  =>\Carbon\Carbon::now(),
]);

$dup=oldPhoto::select('photoID')
->where('locname','=',"$newFileName")
->first();

oldPhoto::where('photoID','=',"$t->photoID")
->update([
   'resized'      =>1,
   'ratio'        => $ratio,
   'exist_check'  =>\Carbon\Carbon::now(),
]);

if(!$dup){
   //make record on old server
   oldPhoto::create([
      'ufid'         => $idFly,
      'umid'         => $umid,
      'origname'     => $t->photoName,
      'locname'      => $newFileName,
      'filesize'     => $newFileSize,
      'ord'          => $t->ord,
      'def'          => $t->def,
      'width'        => $width,
      'height'       => $height,
      'orient'       => $t->orient,
      'resized'      => $resized,
      'ratio'        => $ratio,
      'exist_check'  => \Carbon\Carbon::now(),
   ]);
}


