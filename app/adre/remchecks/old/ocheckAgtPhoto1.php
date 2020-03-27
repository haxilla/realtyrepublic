<?php
//set vars
$agtPhoto            = $mainAccountQuery['agtPhoto'];
$officeID            = $mainAccountQuery['officeID'];
$remailAgentID       = $mainOfficeQuery['remailAgentID'];
//error if none
if(!$officeID||!$remailAgentID){
  if(!$remailAgentID){
    include(app_path().'/synch/set_remailAgentID.php');
    dd('remailAgentIDs just set');}}

$agentPhotoNotes=[];
//agtPhoto
if(!$agtPhoto){
   //no photos to deal with
}else{
  //remote
  $remoteAgtURL="http://www.realtyemails.com/hqoffice/$officeID/$agtPhoto";
  //checkURL
  $contents=@file_get_contents($remoteAgtURL);
  //test if exists
  if(!$contents===FALSE){
    $remoteAgtFound=1;
    $agentPhotoNotes['remoteAgtFound']=1;
  }else{
    $remoteAgtFound=0;
    $agentPhotoNotes['remoteAgtFound']=0;}

  //local
  $localAgtFile="agentPhotos/$remailAgentID/$agtPhoto";
  //check files
  if(file_exists($localAgtFile)){
    $localAgtFound=1;
    $agentPhotoNotes['localAgtFound']=1;
  }else{
    $localAgtFound=0;
    $agentPhotoNotes['localAgtFound']=0;}

  //getRemoteAgtPhoto
  if(!$localAgtFound){
    //if directory doesnt exist create it
    if(!is_dir("agentPhotos/$remailAgentID")){
      mkdir("agentPhotos/$remailAgentID", 0777, true);}
    //set localPath
    $localPath = "agentPhotos/$remailAgentID/$agtPhoto";
    //get image
    file_put_contents($localPath, file_get_contents($remoteAgtURL));
    $localAgtFound=1;
    $agentPhotoNotes['agtPhotoDownload']=1;}}

$remailEventLog['remchecks']['agentPhotoNotes']=$agentPhotoNotes;


