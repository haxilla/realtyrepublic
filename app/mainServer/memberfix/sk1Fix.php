<?php
//get models
use App\models\core\propmeta;
use App\models\oldsite\oldFlyer;
use App\models\remarchives\remailflyersmaster;

$fixCount=request('fixCount');
if(!$fixCount){
  dd('error-line9-sk1Fix.php');}

//query
$fixSK1=propmeta::select('propflyer_id')
->whereNull('sk1')
->orWhere('sk1','like','%'.'='.'%');
$thisCount=$fixSK1->count();
//notice if not needed
if(!$thisCount>0){
  dd('no fix needed');}

//retrieve one record
$recs=1;
$fixSK1=$fixSK1->take($recs)->get();

//gen password funciton
require_once(app_path().'/members/keygens/mdbxGenPswd.php');

// *** start foreach
foreach($fixSK1 as $the){
  //set value
  $digits=rand(10,20);
  $genPswd=generatePassword($digits);
  $sk1=$genPswd;

  //dupCheck
  $dupMeta=propmeta::where('sk1','=',$sk1)
  ->first();
  $dupArchive=remailflyersmaster::where('sk1','=',$sk1)
  ->first();
  $dupOld=oldFlyer::where('sk1','=',$sk1)
  ->first();
  //if dups then exit
  if($dupMeta||$dupArchive||$dupOld){
    //setup response array
    //dup status causes it to rerun
    //with no changes
    $idArray = array(
      'status'        => 'dup',);
    //echo & exit
    echo json_encode($idArray);
    exit();}

  //update current
  propmeta::where('propflyer_id','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);
  //archives
  remailflyersmaster::where('ufid','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);
  //old server
  oldFlyer::where('ufid','=',"$the->propflyer_id")
  ->update([
    'sk1'=>$sk1,]);}
// ***************
// *** end foreach

$thisCount=$thisCount-$recs;
$thisDiff=$fixCount-$thisCount;

//output json & exit
$idArray = array(
  'status'        => 'success',
  'fixCount'      => $fixCount,
  'thisCount'     => $thisCount-1,
  'thisPercent'   => $thisDiff/$fixCount * 100,
);

echo json_encode($idArray);
exit();
