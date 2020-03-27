<?php
include(app_path().'/rets/includes/login.php');
$agentPhotoObject = $rets->GetObject("Agent", "AgentPhoto",$matrixID,'*','1');
//set newRemID
include(app_path().'/functions/keyGens/ezshortUID.php');
$newRemID='zzztest_'.$ezshortUID;
//if no photo present set nulls
$fileName         = null;
$cHeight          = null;
$cWidth           = null;
$orient           = null;
$ratio            = null;
$newFileSize      = null;
//if found run loop & set
if($agentPhotoObject->first()->getLocation()){
	$hasAgtPhoto=1;
   $agentPhoto = $agentPhotoObject->first()->getLocation();
   //check create directory *requires newRemID*
   include(app_path().'/mdbxTrial/makeAgtPhotoDirectories.php');
   //dir path
   $dirPath="agentPhotos/$newRemID/";
   //filename
   $fileName=uniqid().'.jpg';
   //fullPath
   $fullPath=$dirPath.$fileName;
   $fullOriginalPath=$dirPath.'original/'.$fileName;
   //download
   file_put_contents($fullOriginalPath, file_get_contents($agentPhoto));
   //crop
   include(app_path().'/functions/imageControl/trimWhitespace3.php');
   //get dimensions 
   //list[0]=width, 
   //list[1]=height;
   $original=list($width, $height) = getimagesize($fullOriginalPath);
   $cropped=list($width, $height) = getimagesize($fullPath);
   $oWidth=$original[0];
   $cWidth=$cropped[0];
   $oHeight=$original[1];
   $cHeight=$cropped[1];
   //dimensions & filesizes
   $ratio=$width/$height;
   $ratio=round($ratio,4);
   $oldFileSize=filesize($fullOriginalPath);
   $newFileSize=filesize($fullPath);
   //set orient
   if($cWidth > $cHeight){
      $orient='wide';
   }else{
      $orient='tall';}
}
   