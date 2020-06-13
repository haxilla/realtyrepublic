<?php
//set vars
$agtLogo            = $mainAccountQuery['agtLogo'];
$officeID           = $mainAccountQuery['officeID'];
$tempOfficeID       = $mainOfficeQuery['tempOfficeID'];
//error if none
if(!$officeID||!$tempOfficeID){
  dd('error-line7-adre/checkOfficeLogo');}

//agtPhoto
if(!$agtLogo){
  //exists
  $logoExists=0;
  $agentLogoNotes=null;
  $remoteLogoFound=0;
  $localLogoFound=0;
  $agentLogoNotes['logoExists'] = 0;
}else{
  //exists
  $logoExists=1;
  //remote
  $remoteLogoURL="http://www.realtyemails.com/hqoffice/$officeID/logos/$agtLogo";
  //checkURL
  $contents=@file_get_contents($remoteLogoURL);
  //test if exists
  if(!$contents===FALSE){
    $remoteLogoFound=1;
    $agentLogoNotes['remoteLogoFound']  = 1;
    $agentLogoNotes['logoExists']       = 1;
  }else{
    $remoteLogoFound=0;
    $agentLogoNotes['remoteLogoFound']  = 0;
    $agentLogoNotes['logoExists']       = 1;}

  //local
  $localLogoFile="officeLogos/$tempOfficeID/$agtLogo";
  //check files
  if(file_exists($localLogoFile)){
    $localLogoFound=1;
    $agentLogoNotes['localLogoFound']=1;
    $agentLogoNotes['logoExists']       = 1;
  }else{
    $localLogoFound=0;
    $agentLogoNotes['localLogoFound']=0;
    $agentLogoNotes['logoExists']   = 1;}

  //getremote
  if(!$localLogoFound && $remoteLogoFound==1){
    //if directory doesnt exist create it
    if(!is_dir("officeLogos/$tempOfficeID")){
      mkdir("officeLogos/$tempOfficeID", 0777, true);}
    //set localPath
    $localPath = "officeLogos/$tempOfficeID/$agtLogo";
    //get image
    file_put_contents($localPath, file_get_contents($remoteLogoURL));
    $localLogoFound=1;
    $agentLogoNotes['logoExists']     = 1;
    $agentLogoNotes['agtLogoDownload']= 1;}}

if($agentLogoNotes){
  $remailEventLog['remchecks']['agentLogoNotes']=$agentLogoNotes;}

