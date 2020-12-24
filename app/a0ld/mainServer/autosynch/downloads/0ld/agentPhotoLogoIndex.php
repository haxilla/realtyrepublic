<?php
//model
Use App\models\oldsite\oldAgent;

//if both null there is error
if(!$agentPhotoFix && !$agentLogoFix){
   dd('error-line8-agentPhotoLogoIndex.php');}

//one time run only
   //include(app_path().'/synch+/agentPhotoLogo/functions/fullMergeFunction.php');
//query for nulls
include('queries/oldAgentQueries.php');
//defaults
$remoteAgtPhotoURL=0;
$remoteAgtLogoURL=0;
//agentPhotoFix
if($agentPhotoFix){
   //loop
   include('agentPhoto/agentPhotoLoop.php');
   //update old server agtPhoto
   oldAgent::where('umid','=',"$thisID")
   ->update([
      'agtPhotoCheck'=>\Carbon\Carbon::now()]);}

//agentLogoFix
if($agentLogoFix){
   //loop
   include('agentLogo/agentLogoLoop.php');
   //update old server agtLogo
   $newRemID=0;
   oldAgent::where('umid','=',"$thisID")
   ->update([
      'agtLogoCheck'=>\Carbon\Carbon::now()]);}

//set array
$idArray = array(
   'status'             => 'success',
   'propagent_id'       => $thisID,
   'newRemID'           => $newRemID,
   'localPath'          => $localPath,
   'remoteAgtPhotoURL'  => $remoteAgtPhotoURL,
   'remoteAgtLogoURL'   => $remoteAgtLogoURL,
   'agentPhotoFix'      => $agentPhotoFix,
   'agentPhotoFix'      => $agentPhotoFix,
   'agentLogoFix'       => $agentLogoFix,
   'photoCheckCount'    => $photoCheckCount,
   'logoCheckCount'     => $logoCheckCount,);
//echo
echo json_encode($idArray);
//exit
exit();


