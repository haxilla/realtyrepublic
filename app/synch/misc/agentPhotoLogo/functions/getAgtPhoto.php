<?php

//   ***   YOU ARE IN A LOOP
//   ***   CURRENT RECORD IS $thisID

//default
$remoteAgtPhotoFound=0;
$agtPhotoError=0;
//fetch
$contents=@file_get_contents($remoteAgtPhotoURL);
//check
if($contents!==FALSE){
   //tag
   $remoteAgtPhotoFound = 1;}

//error if none
if(!$remoteAgtPhotoFound){
   //send json reply & exit
   $agtPhotoError=1;}

//if no errors, get
if(!$agtPhotoError){
   //make directory if needed
   if(!is_dir("agentPhotos/$newRemID")){
      mkdir("agentPhotos/$newRemID", 0777, true);}
   //get image
   file_put_contents($localPath, file_get_contents($remoteAgtPhotoURL));}


if(!file_exists($localPath)){
   $agtPhotoError=1;}
