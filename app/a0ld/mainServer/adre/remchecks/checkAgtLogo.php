<?php
$remoteAgtLogoFound = 0;
$agtLogoNotes['logoExists'] = 1;
//local
$localAgtLogoFile="officeLogos/$EmployerLicNumber/$agtLogo";
//check files
if(file_exists($localAgtLogoFile)){
  $localAgtLogoFound=1;
  //increment
  $totalAgtLogoFound=$totalAgtLogoFound+1;
  $totalAgtLogoDL=$totalAgtLogoDL+1;
  //log
  $agtLogoNotes['localLogoFound']    = 1;
  $agtLogoNotes['logoExists']        = 1;
  $agtLogoCheck=Carbon\Carbon::now();
}else{
  $localAgtLogoFound=0;
  $agtLogoNotes['localLogoFound'] = 0;
  $agtLogoNotes['logoExists']     = 1;}

if(!$localAgtLogoFound){
  //remote
  $remoteAgtLogoURL="http://www.realtyemails.com/hqoffice/$thisOfficeID/logos/$agtLogo";
  //checkURL
  $contents=@file_get_contents($remoteAgtLogoURL);
  //test if exists
  if(!$contents===FALSE){
    $remoteAgtLogoFound=1;
    $agtLogoNotes['remoteAgtLogoFound']  = 1;
    $agtLogoNotes['agtLogoExists']       = 1;
    $agtLogoCheck=\Carbon\Carbon::now();
  }else{
    $agtLogoNotes['remoteAgtLogoFound']  = 0;
    $agtLogoNotes['remoteAgtLogoURL']  = $remoteAgtLogoURL;
    $agtLogoNotes['logoExists']       = 1;
    $agtLogoCheck=\Carbon\Carbon::now();}}

//getremote
if(!$localAgtLogoFound && $remoteAgtLogoFound==1 && $sqlOK==1){
  //remove old logo if found
  include(app_path().'/adre/functions/removeOldLogo.php');
  //if directory doesnt exist create it
  if(!is_dir("officeLogos/$EmployerLicNumber")){
    mkdir("officeLogos/$EmployerLicNumber", 0777, true);}
  //set localPath
  $localPath = "officeLogos/$EmployerLicNumber/$agtLogo";
  //get image
  file_put_contents($localPath, file_get_contents($remoteAgtLogoURL));
  $localAgtLogoFound=1;
  $totalAgtLogoFound=$totalAgtLogoFound+1;
  $totalAgtLogoDL=$totalAgtLogoDL+1;
  $agtLogoNotes['logoExists']        = 1;
  $agtLogoNotes['agtLogoDownload']   = 1;}
