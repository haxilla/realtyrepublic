<?php

use App\propflyer;
use App\propmeta;
use App\propphoto;
use App\qcreate;

//get photos that are not resized for this ID
$needResize=propphoto::select('photoName','orient','ord','def','ratio','oldFileSize')
->where('propflyer_id','=',"$id")
->whereNull('resized')
->whereNull('resize_h')
->whereNull('resize_w')
->orderBy('ord')
->get();

//get directories
$checkProp=propmeta::where('propflyer_id','=',"$id")
->first();

if($checkProp){

   $zipDir=propmeta::where('propflyer_id','=',"$id")
   ->pluck('zipDir')
   ->first();

   $mlsDir=propmeta::where('propflyer_id','=',"$id")
   ->pluck('mlsDir')
   ->first();

}else{

   $zipDir=qcreate::where('id','=',"$id")
   ->pluck('zipDir')
   ->first();

   $mlsDir=qcreate::where('id','=',"$id")
   ->pluck('mlsDir')
   ->first();

}


//loop through values and resize
foreach($needResize as $nr){

   $photoName     = $nr->photoName;
   $orient        = $nr->orient;
   $ord           = $nr->ord;
   $def           = $nr->def;
   $ratio         = $nr->ratio;
   $photoLoc      = "hqphotos/$zipDir/$mlsDir/";
   $photoPath     = "hqphotos/$zipDir/$mlsDir/$photoName";
   $oldFileName   = $nr->photoName;
   $oldFileSize   = $nr->oldFileSize;

   //if tall resize to 300height otherwise 300wide
   if($orient==='tall'){
      $resize_h='300';
      $targetWidth=$resize_h*$ratio;
      $resize_w=round($targetWidth);
      $filePrefix='h300';
      //echo "<BR>ORIENT: $orient - H: $newHeight X W: $targetWidth<BR>";
   }else{
      $resize_w='500';
      $targetHeight=$resize_w/$ratio;
      $resize_h=round($targetHeight);
      $filePrefix='w500';
      //echo "<BR>ORIENT: $orient - W: $newWidth X H: $targetHeight<BR>";
   }

   //set variables for photo resizing
   $file=$photoPath;
   $resizedName="$filePrefix-$photoName";
   $resizedLoc="hqphotos/$zipDir/$mlsDir/$resizedName";

   //include image optimize function
   require_once('imageOptimize.php');

   //call the function (when passing path to pic)
   smart_resize_image($file ,null, $resize_w, $resize_h, false, $resizedLoc, false, false, 90 );

   //re-assign the name and resized values
   $newFileName=$resizedName;
   $newFileSize=filesize($resizedLoc);
   $resized=500;

   //update the original record to show its resized
   propphoto::where('photoName','=',"$photoName")
   ->update([
      'resize_w' => $resize_w,
      'resize_h' => $resize_h,
   ]);

   //insert into database
   propphoto::create([

      'oldFileName'  => $oldFileName,
      'oldFileSize'  => $oldFileSize,
      'newFileSize'  => $newFileSize,
      'resized'      => $resized,
      'resize_w'     => $resize_w,
      'resize_h'     => $resize_h,
      'photoName'    => $newFileName,
      'propflyer_id' => $idFly,
      'propagent_id' => Auth::user()->id,
      'ord'          => $ord,
      'def'          => $def

   ]);

};


