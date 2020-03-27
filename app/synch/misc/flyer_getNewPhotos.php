<?php

//get models
use App\models\core\propphoto;
use App\models\oldsite\oldPhoto;
use App\models\oldsite\oldFlyer;
use Illuminate\Support\Facades\URL;
//live or local
$url=url::current();
if (strpos($url, 'realtyrepublic.com') !== false){
//must be url above or reject
}else{
  dd('USE LIVE SITE');}

//get count
$checkPhotoQuery=propphoto::select('photoID',
  'propflyer_id','photoName')
->whereNull('existCheck')
->where('photoDate','>','2016-08-01')
->with(['theMeta'=>function($q){
   $q->select('propagent_id','propflyer_id','zipDir','mlsDir');
}]);
//set photoCount
$checkPhotoCount=$checkPhotoQuery->count();
//get 1 for jquery loader
$checkPhoto=$checkPhotoQuery
->take(1)
->get();
//default variables
$totalRecords=$checkPhotoCount;
$status='complete';
$remoteURL='complete';
$localURL='complete';
$photoID='complete';
$localFound=0;
$remoteFound=0;
$notFound=0;
$existCheck=\Carbon\Carbon::now();
//run loop
foreach($checkPhoto as $the){
  //start as success change conditionally if needed
  $status="success";
  //error if no zipDir or mlsDir
  if(!$the->theMeta||!$the->photoName){
    dd('error-line43-appPath/synch/flyer_getNewPhotos',$checkPhoto,$the->propflyer_id);}

  $oldFlyer=oldFlyer::where('ufid','=',$the->propflyer_id)
  ->select('zipDir','mlsDir')
  ->first();

  if(!$oldFlyer){
    dd('error-line52-app/synch/flyer_getNewPhotos');}

  $oldZipDir=$oldFlyer['zipDir'];
  $oldMlsDir=$oldFlyer['mlsDir'];

  if(!$oldZipDir||!$oldMlsDir){
    dd('error-line61-app/synch/flyer_getNewPhotos');}

  //set vars
  $photoName  = $the->photoName;
  $zipDir     = $the->theMeta->zipDir;
  $mlsDir     = $the->theMeta->mlsDir;
  //rawurlencode
  $oldZipDir=rawurlencode($oldZipDir);
  $oldMlsDir=rawurlencode($oldMlsDir);

  //set remote
  $remoteURL="http://www.realtyemails.com/hqphotos/$oldZipDir/$oldMlsDir/$photoName";
  //set local
  $localURL="hqphotos/$zipDir/$mlsDir/$photoName";
  $photoID=$the->photoID;
  //set date for consistency
  $existCheck=\Carbon\Carbon::now();
  //check local
  if(file_exists($localURL)){
    $localFound=1;}

  //Check for remote if local file not found
  //remote = realtemails.com
  //local  = realtyrepublic.com
  if($localFound==0){
    $contents=@file_get_contents($remoteURL);
    if($contents===FALSE){
       $notFound=1;
    }else{
       $remoteFound=1;}}

  ///Check results and perform action
  if($localFound==0 && $remoteFound==1){
    //change for status
    //$status="getRemote";
    //make directory if needed
    if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
      mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
    //get file
    file_put_contents($localURL, file_get_contents($remoteURL));}

  //update LOCAL
  propphoto::where('photoID','=',"$the->photoID")
  ->update([
     'existCheck'   => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
  //update REMOTE
  oldPhoto::where('photoID','=',"$the->photoID")
  ->update([
     'exist_check'  => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
}

//output json & exit
$idArray = array(
  'status'        => $status,
  'remoteURL'     => $remoteURL,
  'localURL'      => $localURL,
  'notFound'      => $notFound,
  'localFound'    => $localFound,
  'remoteFound'   => $remoteFound,
  'totalRecords'  => $totalRecords,
  'photoID'       => $photoID,
  'existCheck'    => $existCheck->toDateTimeString(),
);

echo json_encode($idArray);
exit();
