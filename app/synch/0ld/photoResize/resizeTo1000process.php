<?php
//set model
use App\models\core\propphoto;
use App\models\oldsite\oldPhoto;

//set photoName
$notFound=0;
$photoName=$t->photoName;
//if not there / get it
$fileExists=1;
$remoteURL="http://www.realtyemails.com/HQPhotos/$zipDir/$mlsDir/$photoName";
$localPath = "hqphotos/$zipDir/$mlsDir/$photoName";
contents=@file_get_contents($remoteURL);
if($contents===FALSE){$
  $notFound=1;
  //oldsite
  oldPhoto::where('photoID','=',"$t->photoID")
  ->update([
    'notfound'=>$notFound,
    'resized'=>3,
    'exist_check'=>\Carbon\Carbon::now(),
  ]);
  //propphoto
  propphoto::where('photoID','=',"$t->photoID")
  ->update([
    'notFound'    => $notFound,
    'resized'     => 3,
    'existCheck'  => \Carbon\Carbon::now(),
  ]);
}

if($notFound){

  //if it doesnt exist, get it
  if(!file_exists("hqphotos/$zipDir/$mlsDir/$photoName")){
    $fileExists=0;
    file_put_contents($localImage, file_get_contents($remoteURL));
  }//end !if file_exists()

  $ratioUpdate=0;
  //check if ratio
  if($the->ratio == 0){
  $ratioUpdate=1;
  $width=$t->width;
  $height=$t->height;
  $ratio=$width/$height;
  $ratio=round($ratio,4);
  //update database
  propphoto::where('propflyer_id','=',"$idFly")
  ->update([
    'ratio'=>$ratio
  ]);}

  //run localImage through image optimizer
  include(app_path().'/functions/imageControl/flyerPhotos1000w600h.php');

}



