<?php
//  *******************************
//  **  YOU ARE IN A LOOP
//  **  Current Record is $thisDup
//  *******************************

if(!$newRemID){
  include(app_path().'/adre/functions/getNewRemID.php');}
//local
$localAgtPhotoFile="agentPhotos/$newRemID/$agtPhoto";

//check files
if(file_exists($localAgtPhotoFile)){
  $localAgtPhotoFound=1;
  $totalAgtPhotoFound=$totalAgtPhotoFound+1;
  $totalAgtPhotoDL=$totalAgtPhotoDL+1;
  $agtPhotoNotes['localFileFound'][$thisDup]=$localAgtPhotoFile;
  $agtPhotoNotes['localAgtPhotoFound'][$thisDup]=1;
  $agtPhotoCheck=Carbon\Carbon::now();
}else{
  $agtPhotoNotes['localAgtPhotoFound']=0;}
//default
if(!$localAgtPhotoFound){
  //remote
  $remoteAgtPhotoURL="http://www.realtyemails.com/hqoffice/$thisOfficeID/$agtPhoto";
  //checkURL
  $contents=@file_get_contents($remoteAgtPhotoURL);
  //test if exists
  if(!$contents===FALSE){
    $remoteAgtPhotoFound  = 1;
    $agtPhotoNotes['remoteAgtPhotoFound']=1;
    $agtPhotoCheck=\Carbon\Carbon::now();
  }else{
    $agtPhotoNotes['remoteAgtPhotoFound']=0;
    $agtPhotoNotes['remoteAgtPhotoURL']=$remoteAgtPhotoURL;
    $agtPhotoCheck=\Carbon\Carbon::now();}}

//getRemoteAgtPhoto
if(!$localAgtPhotoFound && $remoteAgtPhotoFound && $sqlOK=='1'){
  //if directory doesnt exist create it
  if(!is_dir("agentPhotos/$newRemID")){
    mkdir("agentPhotos/$newRemID", 0777, true);}
  //set localPath
  $localPath = "agentPhotos/$newRemID/$agtPhoto";
  //get image
  file_put_contents($localPath, file_get_contents($remoteAgtPhotoURL));
  //variables
  $localAgtPhotoFound = 1;
  $totalAgtPhotoDL    = $totalAgtPhotoDL+1;
  $totalAgtPhotoFound = $totalAgtPhotoFound+1;
  $agtPhotoNotes['agtPhotoDownload']      = 1;}
