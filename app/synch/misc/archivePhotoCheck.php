<?php
use App\models\maindata\maindataRemailPhoto;
use App\models\maindata\maindataRemailFlyer;
use App\models\core\propphoto;
use App\models\oldsite\oldPhoto;
use Illuminate\Support\Facades\URL;
//query
$checkListQuery=maindataRemailPhoto::select('photoID','ufid',
   'umid','locname')
->whereNull('exist_check')
->where('photoDate','>','2018-06-15')
->with(['theFlyer'=>function($q){
   $q->select('zipDir','mlsDir','ufid');
}])
->with(['currentRecord'=>function($q){
   $q->select('propflyer_id','photoID');
}])
->with(['oldPhotoRecord'=>function($q){
   $q->select('photoID');
}]);
//set count
$totalRecords=$checkListQuery->count();
//just one for jquery
$checkList=$checkListQuery->take(1)->get();
//live or local
$url=url::current();
if(strpos($url,'realtyrepublic.com') !== false){
   $live=1;
}else{
   $live=0;}
//set defaults
$notFound=0;
//run loop
foreach($checkList as $the){

   //set variables
   $existCheck=\Carbon\Carbon::now();
   $zipDir=trim($the->theFlyer->zipDir);
   $mlsDir=trim($the->theFlyer->mlsDir);
   $photoName=trim($the->locname);
   $localPath="hqphotos/$zipDir/$mlsDir/$photoName";
   $localPrefix='https://www.realtyrepublic.com';
   $remotePrefix='http://www.realtyemails.com';
   //REALTYEMAILS=REMOTEURL
   $remoteURL="$remotePrefix/$localPath";
   //REALTYREPUBLIC=LOCALURL
   $localURL="$localPrefix/$localPath";
   //REMOTE - 0 or 1
   $contents=@file_get_contents($remoteURL);
   if($contents===FALSE){
      $remoteFound=0;
   }else{
      $remoteFound=1;}
   //localFound - 0 or 1
   //live means check file not URL
   if($live=='1'){
      //check file
      if(file_exists($localPath)){
         $localFound=1;
      }else{
         $localFound=0;}

   }else{
      //if not live use URL
      //localFound - 0 or 1
      $contents=@file_get_contents($localURL);
      if($contents===FALSE){
         $localFound=0;
      }else{
         $localFound=1;}}

   //if not found
   if($remoteFound==0 && $localFound==0){

      $notFound=1;
      //return result
      if($the->oldPhotoRecord){
         oldPhoto::destroy($the->photoID);}
      //delete from propphoto
      if($the->currentRecord){
         propphoto::destroy($the->photoID);}

      //delete from archivePhoto
      maindataRemailPhoto::destroy($the->photoID);
      //setup json reply
      $idArray = array(
        'status'        => 'getPhoto',
        'remoteURL'     => $remoteURL,
        'localURL'      => $localURL,
        'localPath'     => $localPath,
        'notFound'      => $notFound,
        'localFound'    => $localFound,
        'remoteFound'   => $remoteFound,
        'totalRecords'  => $totalRecords,
        'photoID'       => $the->photoID,
        'existCheck'    => $existCheck->toDateTimeString(),
      );
      //output & exit
      echo json_encode($idArray);
      exit();
   }

   //found on realtyemails but not realtyrepublic
   if($remoteFound==1 && $localFound!==1){
      //if not live move error
      if(!$live=='1'){
         dd('Use remote server to initiate download!');}

      //make directory if needed
      if (!is_dir("hqphotos/$zipDir/$mlsDir")){
         mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
      //get file
      file_put_contents($localPath, file_get_contents($remoteURL));
      //mark found
      $localFound=1;
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
      //update archive
      maindataRemailPhoto::where('photoID','=',"$the->photoID")
      ->update([
         'exist_check'  =>\Carbon\Carbon::now(),
         'notFound'     => $notFound,
         'localFound'   => $localFound,
         'remoteFound'  => $remoteFound
      ]);

      //setup json reply
      $idArray = array(
        'status'        => 'getPhoto',
        'remoteURL'     => $remoteURL,
        'localURL'      => $localURL,
        'localPath'     => $localPath,
        'notFound'      => $notFound,
        'localFound'    => $localFound,
        'remoteFound'   => $remoteFound,
        'totalRecords'  => $totalRecords,
        'photoID'       => $the->photoID,
        'existCheck'    => $existCheck->toDateTimeString(),
      );
      //output & exit
      echo json_encode($idArray);
      exit();
   }

   //found on local but not remote
   if($localFound==1 && $remoteFound==0){
      //delete image from local
      unlink($localPath);
      //remove record from local
      maindataRemailPhoto::destroy($the->photoID);
      //delete on other tables too
      if($the->oldPhotoRecord){
         oldPhoto::destroy($the->photoID);}
      //delete from propphoto
      if($the->currentRecord){
         propphoto::destroy($the->photoID);}

      //setup json
      $idArray = array(
        'status'        => 'deleteLocalNoRemote',
        'remoteURL'     => $remoteURL,
        'localURL'      => $localURL,
        'localPath'     => $localPath,
        'notFound'      => $notFound,
        'localFound'    => $localFound,
        'remoteFound'   => $remoteFound,
        'totalRecords'  => $totalRecords,
        'photoID'       => $the->photoID,
        'existCheck'    => $existCheck->toDateTimeString(),
      );
      //output & exit
      echo json_encode($idArray);
      exit();
   }

   //** DEFAULT UPDATE
   //update archive
   maindataRemailPhoto::where('photoID','=',"$the->photoID")
   ->update([
      'exist_check'=>\Carbon\Carbon::now(),
      'notFound'     => $notFound,
      'localFound'   => $localFound,
      'remoteFound'  => $remoteFound
   ]);
   //output json & exit
   $idArray = array(
   'status'        => 'update',
   'remoteURL'     => $remoteURL,
   'localURL'      => $localURL,
   'localPath'     => $localPath,
   'notFound'      => $notFound,
   'localFound'    => $localFound,
   'remoteFound'   => $remoteFound,
   'totalRecords'  => $totalRecords,
   'photoID'       => $the->photoID,
   'existCheck'    => $existCheck->toDateTimeString(),
   );

   echo json_encode($idArray);
   exit();
}
