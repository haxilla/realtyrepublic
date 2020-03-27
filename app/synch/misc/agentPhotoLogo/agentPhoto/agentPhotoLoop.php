<?php
//model
Use App\models\core\propagentcleanup;

//loop select('agentPhoto','officeID','umid')
//     whereNotNull('agentPhoto')
//     oldSite/oldAgent

//default
$needsDownload=0;
$agtPhotoError=0;
$existingRemID=1;
//photoCheckQuery Loop
foreach($photoCheckQuery as $the){
   //variables
   $thisID=$the->umid;
   $thisPhoto=$the->agentPhoto;
   $officeID=$the->officeID;
   //query
   $propagentcleanup=propagentcleanup::where('propagent_id','=',"$thisID")
   ->select('newRemID')
   ->first();
   //get newRemID
   $newRemID=$propagentcleanup['newRemID'];
   //if none, create
   if(!$newRemID){
      //tag
      $needsDownload=1;
      $existingRemID=0;
      //get
      include(app_path().'/functions/keyGens/ezshortUID.php');
      //set
      $newRemID=$ezshortUID;}

   //set local path
   $localPath="agentPhotos/$newRemID/$thisPhoto";
   //remote
   $remoteAgtPhotoURL="http://www.realtyemails.com/HQoffice/$officeID/$thisPhoto";
   //check if DL needed
   if(!file_exists($localPath)){
      //tag
      $needsDownload=1;}

   //getAgtPhoto
   if($needsDownload){
      include(app_path().'/synch/agentPhotoLogo/functions/getAgtPhoto.php');}

   //create or update new record
   include(app_path().'/synch/agentPhotoLogo/sql/newRemID_createUpdate.php');}
   //   ***   end of FOREACH LOOP   ***   //

