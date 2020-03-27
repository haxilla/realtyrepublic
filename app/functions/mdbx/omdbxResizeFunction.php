<?php

use App\models\core\propphoto;
use App\models\core\propmeta;

$resizeThis=propphoto::where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->where('resized','=',null)
->get();

$propMetas=propmeta::select('zipDir','mlsDir')
->where('propflyer_id','=',"$idFly")
->where('propagent_id','=',"$umid")
->first();

$zipDir=$propMetas['zipDir'];
$mlsDir=$propMetas['mlsDir'];

if($resizeThis->count()>0){

   foreach($resizeThis as $rt){
      //if tall resize to 300height otherwise 300wide
      if($rt->orient==='tall'){
         $resize_h='300';
         $targetWidth=$resize_h*$rt->ratio;
         $resize_w=round($targetWidth);
         $filePrefix='h300';
         //echo "<BR>ORIENT: $orient - H: $newHeight X W: $targetWidth<BR>";
      }else{
         $resize_w='500';
         $targetHeight=$resize_w/$rt->ratio;
         $resize_h=round($targetHeight);
         $filePrefix='w500';
         //echo "<BR>ORIENT: $orient - W: $newWidth X H: $targetHeight<BR>";
      }

      //set variables for photo resizing
      $photoPath     = "hqphotos/$zipDir/$mlsDir/$rt->photoName";
      $file          = $photoPath;
      $resizedName   = "$filePrefix-$rt->photoName";
      $resizedLoc    = "hqphotos/$zipDir/$mlsDir/$resizedName";

      //include image optimize function
      require_once('mdbxImageOptimize.php');

      //call the function (when passing path to pic)
      smart_resize_image($file ,null, $resize_w, $resize_h, false, $resizedLoc, false, false, 90 );

      //re-assign the name and resized values
      $newFileName=$resizedName;
      $newFileSize=filesize($resizedLoc);
      $resized=500;

      //add dimension values of original - gets width/height
      list($width, $height) = getimagesize($resizedLoc);

      //get new dimensions & add values
      $ratio=$width/$height;
      $ratio=round($ratio,4);

      propphoto::where('photoID','=',"$rt->photoID")
      ->update([
         'resized'=>1
      ]);

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
         'oldFileName'  => $rt->photoName,
         'oldFileSize'  => $rt->oldFileSize,
         'orient'       => $rt->orient,
         'propflyer_id' => $idFly,
         'propagent_id' => $umid,
         'ord'          => $rt->ord,
         'def'          => $rt->def
      ]);
   }
}
