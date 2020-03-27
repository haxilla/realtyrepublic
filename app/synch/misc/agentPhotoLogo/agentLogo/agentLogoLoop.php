<?php
//model
Use App\models\core\agtoffice;

//loop select('agentPhoto','officeID','umid')
//     whereNotNull('agentLogo')
//     where('agentLogo','!=','logosample.gif')
//     oldSite/oldAgent

//default
$needsDownload=0;
$agtLogoError=0;
//photoCheckQuery Loop
foreach($logoCheckQuery as $the){
   //variables
   $thisID=$the->umid;
   $thisLogo=$the->logo;
   $officeID=$the->officeID;
   $getLocalOffice=agtoffice::where('propagent_id','=',$thisID)
   ->select('officeID')
   ->first();
   $localOfficeID=$getLocalOffice['officeID'];
   //set local path
   $localPath="officeLogos/$localOfficeID/$thisLogo";
   //remote
   $remoteAgtLogoURL="http://www.realtyemails.com/HQoffice/$officeID/logos/$thisLogo";
   //check if DL needed
   if(!file_exists($localPath)){
      //tag
      $needsDownload=1;}

   //getAgtPhoto
   if($needsDownload){
      include(app_path().'/synch/agentPhotoLogo/functions/getAgtLogo.php');}

   //create or update new record
   include(app_path().'/synch/agentPhotoLogo/sql/officeLogo_createUpdate.php');}
   //   ***   end of FOREACH LOOP   ***   //

