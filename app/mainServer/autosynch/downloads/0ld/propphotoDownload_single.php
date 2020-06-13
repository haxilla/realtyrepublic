<?php

//get models
use App\autosynch\models\propphoto\propphotos;
use App\autosynch\models\propphoto\propphotoOld;
use App\autosynch\models\propphoto\propphotoOldArc;
use App\autosynch\models\propphoto\propphotoCurArc;
use App\autosynch\models\propflyer\propflyerOld;

//increase memory for this one
ini_set('memory_limit', '512M');

//get count
$checkPhotoQuery=propphotos::select('photoID',
  'propflyer_id','photoName')
->whereNull('existCheck')
->where('photoDate','>','2017-01-01')
->with(['theMeta'=>function($q){
   $q->select('propagent_id','propflyer_id','zipDir','mlsDir');
}]);

//default variables
$totalRecords=$checkPhotoQuery->count();

if($totalRecords>0){
  $status="resume";
}else{
  $status="complete";
  include(app_path().'/autosynch/log/completeLog.php');}

//get 1
$checkPhoto=$checkPhotoQuery
->first();

//new vars at start of each loop
$remoteURL=null;
$localURL=null;
$photoID=null;
$localFound=0;
$remoteFound=0;
$notFound=0;
$deleteFound=0;

//set vars
$flyerID=$checkPhoto['propflyer_id'];

//error if no zipDir or mlsDir
$oldMeta=propflyerOld::where('ufid','=',$flyerID)
->select('zipDir','mlsDir')
->first();

$oldZipDir=$oldMeta['zipDir'];
$oldMlsDir=$oldMeta['mlsDir'];

if(!$oldZipDir||(!$oldMlsDir && $oldMlsDir !=0)){
  include('functions/fixMetaFail.php');}

//set vars
$photoName  = $checkPhoto['photoName'];
$zipDir     = trim($checkPhoto['zipDir']);
$mlsDir     = trim($checkPhoto['mlsDir']);

//rawurlencode
$oldZipDir=rawurlencode($oldZipDir);
$oldMlsDir=rawurlencode($oldMlsDir);
  
//set local
$localURL="hqphotos/$zipDir/$mlsDir/$photoName";

//check local
if(file_exists($localURL)){
  $localFound=1;}

//Check for remote if local file not found
//remote = realtyemails.com
//local  = realtyrepublic.com
if($localFound != 1){
  include('functions/findRemote.php');}

// Check results and perform action
if($localFound !=1 && ($remoteFound==1||$deleteFound==1)){
  include('functions/downloadRemote.php');}

//set existCheck
$existCheck=\Carbon\Carbon::now();
  
//update LOCAL
propphotos::where('photoName','=',"$photoName")
->update([
   'existCheck'   => $existCheck,
   'notFound'     => $notFound,
   'localFound'   => $localFound,
   'remoteFound'  => $remoteFound,
]);

//update REMOTE
propphotoOld::where('locname','=',"$photoName")
->update([
   'exist_check'  => $existCheck,
   'notFound'     => $notFound,
   'localFound'   => $localFound,
   'remoteFound'  => $remoteFound,
]);

//update REMOTE Archive
propphotoOldArc::where('locname','=',"$photoName")
->update([
   'exist_check'  => $existCheck,
   'notFound'     => $notFound,
   'localFound'   => $localFound,
   'remoteFound'  => $remoteFound,
]);

//update LOCAL Archive
propphotoCurArc::where('locname','=',"$photoName")
->update([
   'exist_check'  => $existCheck,
   'notFound'     => $notFound,
   'localFound'   => $localFound,
   'remoteFound'  => $remoteFound,
]);