<?php
use App\models\admin\photoError;
$agtPhotoNotes=[];
if($getAgent['agtPhoto'] && $getAgent['agtPhoto'] != 'agentsample.gif'){
   //set & log
   $agtPhotoError=0;
   $hasAgtPhoto=1;
   $agtPhoto=$getAgent['agtPhoto'];
   $images[$thisID]['agtphoto']=$agtPhoto;
   //does it exist
   include(app_path().'/adre/remchecks/checkAgtPhoto.php');
   //if none set error
   if(!$localAgtPhotoFound && !$remoteAgtPhotoFound){
      $agtPhotoNotes[$thisID]['photoError']=$thisDup;
      $agtPhotoError=1;}
}else{
   $agtPhotoNotes[$thisID]['noPhoto']=$thisDup;
   $localAgtPhotoFound=0;
   $remoteAgtPhotoFound=0;}

if($agtPhotoError && $sqlOK==1){
   photoError::create([
      'propagent_id' => $thisDup,
      'photoURL'     => $remoteAgtPhotoURL,
   ]);}
