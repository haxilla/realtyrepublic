
<?php

//get models
Use App\models\core\propagent;

//set user id
$umid=Auth::guard('member')->user()->id;

//error if missing criteria
if(!$umid||empty($_FILES)||empty($_POST)){
	dd('error');}

//metacheck
$getOffice=propagent::where('id','=',$umid)
->select('officeID')
->first();
//exit if none
if(!$getOffice){
  $idArray = array(
  "status"    => 'Fail',
  "message"   => 'Office ID Not Found');
  //echo and exit
  echo json_encode($idArray);
  exit();}

//set newRemID
$officeID=$getOffice['officeID'];
$folderPath = "officeLogos/$officeID";

//set file info
$tmpFile = $_FILES['fileSelect']['tmp_name']; 
$sourceProperties = getimagesize($tmpFile);
$ext = pathinfo($_FILES['fileSelect']['name'], PATHINFO_EXTENSION);
$width=$sourceProperties[0];
$height=$sourceProperties[1];
$imageType = $sourceProperties[2];
$ratio=$width/$height;
$ratio=round($ratio,4);

//get orient
if($width>$height){
  $orient='wide';
}else{
  $orient='tall';}

//error if not an image
if(!$imageType){
  //setup values
  $idArray = array(
    "status"    => 'Fail',
    "message"   => 'Unsupported Image Type');
  //echo and exit
  echo json_encode($idArray);
  exit();}

//if directory doesnt exist create it
if (!is_dir("$folderPath")) {
  mkdir("$folderPath", 0777, true);}

//new file name
$newFileName = uniqid().'-'.time().'.'.$ext;
$newFilePath=$folderPath."/$newFileName";

//move file
if(move_uploaded_file($tmpFile,$newFilePath)){
  
  //get filesize
  $fileSize=filesize($newFilePath);

  //update database
  propagent::where('id','=',$umid)
  ->update([
    'agtLogo'          => $newFileName,
    'agtLogoHeight'    => $height,
    'agtLogoWidth'     => $width,
    'agtLogoRatio'     => $ratio,
    'agtLogoOrient'    => $orient,
    'agtLogoFileSize'  => $fileSize,
  ]);

  //setup values
  $idArray = array(
    "status"            => 'Success',
    "message"           => 'Agent Logo Uploaded',
    "officeID"          => $officeID,
    "sourceProperties"  => $sourceProperties,
    "width"             => $width,
    "height"            => $height,
    "ratio"             => $ratio,
    "orient"            => $orient,
    "newFileName"       => $newFileName,
    "newFilePath"       => $newFilePath,);

  //echo and exit
  echo json_encode($idArray);
  exit();
};

