<?php
//set model
use App\models\core\propphoto;
use App\models\core\propflyer;
use App\models\oldsite\oldPhoto;
//determine if local or live
include(app_path().'/codeClips/liveOrLocal.php');
//default variable
include('variables/starterVariables.php');
//newFlyerQuery with(thePhotos) where resized=0;
include('queries/propflyerQuery.php');
//function called on from loop
include(app_path().'/functions/imageControl/mdbxImageOptimize.php');
//loop through results
foreach($newFlyerRecord as $the){
  //assigns variables - errors if none
  include('newFlyerLoop.php');
  //resize loop
  foreach($the->thePhotos as $t){
    //if not found, check for and download remote
    include('functions/checkRemote.php');
    //above returns 0 or 1 for localFound
    if($localFound && $t->width > 1000){
      //if original is larger than 1000
      include('functions/flyerPhotos1000w600h.php');}
      //otherwise...
    else{
      //update
      include('queries/updatePropPhoto.php');}
      //end of if width>1000
    //increment photoCount
    $thisPhotoCount++;
    //return JSON & exit
    include('json/jsonValues.php');}};
    //end both forEach

