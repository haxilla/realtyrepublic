<?php

//   ***   YOU ARE IN A LOOP
//   ***   CURRENT RECORD IS $thisID

//default
$remoteAgtLogoFound=0;
$agtLogoError=0;
//fetch
$contents=@file_get_contents($remoteAgtLogoURL);
//check
if($contents!==FALSE){
   //tag
   $remoteAgtLogoFound = 1;}

//error if none
if(!$remoteAgtLogoFound){
   //send json reply & exit
   $agtLogoError=1;}

//if no errors, get
if(!$agtLogoError){
   //make directory if needed
   if(!is_dir("officeLogos/$localOfficeID")){
      mkdir("officeLogos/$localOfficeID", 0777, true);}
   //get image
   file_put_contents($localPath, file_get_contents($remoteAgtLogoURL));}
