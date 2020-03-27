<?php
//set vars
$agtPhoto            = $mainAccountQuery['agtPhoto'];
$officeID            = $mainAccountQuery['officeID'];
$remailAgentID       = $agtOfficeQuery['remailAgentID'];
//agtPhoto
if(!$agtPhoto){
   //no photos to deal with
}else{
   //remote
   $remoteAgtURL="http://www.realtyemails.com/hqoffice/$tempOfficeID/$agtPhoto";
   //checkURL
   $contents=@file_get_contents($remailAgtURL);
   //test if exists
   if(!$contents===FALSE){
      $remoteAgtFound=1;
   }else{
      $remoteAgtFound=0;}
   //local
   $localAgtFile="agentPhotos/$remailAgentID/$agtPhoto";
   //check files
   if(file_exists($localAgtFile)){
      $localAgtFound=1;
   }else{
      $localAgtFound=0;}

   //if notFound
   if(!$remoteFound){
      dd('NOT THERE');
      //delete database record to outdated url
   }else{

      //make directory if needed
      if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
      mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
      //get file
      file_put_contents($localURL, file_get_contents($remoteURL));}}

}

   //$remoteLogoURL="http://www.realtyemails.com/hqoffice/$tempOfficeID/logos/$agtLogo";


  ///Check results and perform action
  if($localFound==0 && $remoteFound==1){
    //change for status
    //$status="getRemote";





