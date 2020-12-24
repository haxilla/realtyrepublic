<?php

<?php
//get models
use App\autosynch\models\propphoto\propphotos;
use App\autosynch\models\propphoto\propphotoOld;
use App\autosynch\models\propphoto\propphotoOldArc;
use App\autosynch\models\propphoto\propphotoCurArc;
use App\autosynch\models\propflyer\propflyerOld;

//increase memory for this one
//ini_set('memory_limit', '512M');

//get count
$checkPhotoQuery=propphotos::select('photoID',
  'propflyer_id','photoName')
->whereNull('existCheck')
->where('photoDate','>','2017-01-01')
->with(['theMeta'=>function($q){
   $q->select('propagent_id','propflyer_id','zipDir','mlsDir');
}]);

//get totalRecords
$totalRecords=$checkPhotoQuery->count();

//log if complete
if($totalRecords<1){
  include(app_path().'/autosynch/log/completeLog.php');}

//set query
$checkPhoto=$checkPhotoQuery
->take(1000)
->get();

//run loop
foreach($checkPhoto as $the){
  //new vars at start of each loop
  $remoteURL=null;
  $localURL=null;
  $photoID=null;
  $localFound=0;
  $remoteFound=0;
  $notFound=0;
  $deleteFound=0;
  //error if no zipDir or mlsDir
  $oldMeta=propflyerOld::where('ufid','=',$the->propflyer_id)
  ->select('zipDir','mlsDir')
  ->first();

  //set oldZipDir & oldMlsDir
  $oldZipDir=$oldMeta['zipDir'];
  $oldMlsDir=$oldMeta['mlsDir'];

  //try to fix if error
  if(!$oldZipDir||!$oldMlsDir){
    include('functions/fixMetaFail.php');}

  //set local zipDir & mlsDir
  if($the->theMeta){
    $zipDir     = trim($the->theMeta->zipDir);
    $mlsDir     = trim($the->theMeta->mlsDir);
  }else{
    $zipDir     = trim($oldZipDir);
    $mlsDir     = trim($oldMlsDir);}
  
  //rawurlencode
  $oldZipDir=rawurlencode($oldZipDir);
  $oldMlsDir=rawurlencode($oldMlsDir);
  
  //set local
  $localURL="hqphotos/$zipDir/$mlsDir/$the->photoName";
  $photoID=$the->photoID;
  
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
  propphotos::where('photoName','=',"$the->photoName")
  ->update([
     'existCheck'   => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
  
  //update REMOTE
  propphotoOld::where('locname','=',"$the->photoName")
  ->update([
     'exist_check'  => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
  //update REMOTE Archive
  propphotoOldArc::where('locname','=',"$the->photoName")
  ->update([
     'exist_check'  => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
  //update LOCAL Archive
  propphotoCurArc::where('locname','=',"$the->photoName")
  ->update([
     'exist_check'  => $existCheck,
     'notFound'     => $notFound,
     'localFound'   => $localFound,
     'remoteFound'  => $remoteFound,
  ]);
}