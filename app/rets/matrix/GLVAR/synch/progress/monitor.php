<?php

Use App\rets\models\retsLog;

//check URL
$logID=request('logID');
$retsID=request('retsID');
$theStatus='Pending';

//if no logID
if(!$logID){
	include("getLogID.php");}

//query for values
$checkLog=retsLog::where('logID','=',$logID)
->first();

//variables
$thisModel=$checkLog['thisModel'];
$thisCount=$checkLog['thisCount'];
$thisTotal=$checkLog['thisTotal'];
$thisProcess=$checkLog['thisProcess'];
$tableDrop=$checkLog['tableDrop'];
$insertNow=$checkLog['insertNow'];
$nextSynch=$checkLog['nextSynch'];
$thisClass=$checkLog['retsClass'];

//
if($insertNow && $thisModel){
	$thisCount=$thisModel::count();}
//
if($nextSynch=='Compare'){
	$theStatus='synchComplete';}

//set percentage
$thisPercent=0;

//calculate when possible
if($thisCount>0 && $thisTotal>0){
	$thisPercent=$thisCount/$thisTotal*100;
	$thisPercent=round($thisPercent,2);}

//echo & exit
$idArray=array(
	'logID'			=> $logID,
	'retsID'		=> $retsID,
	'theStatus'		=> $theStatus,
	'thisCount'		=> $thisCount,
	'thisTotal'		=> $thisTotal,
	'thisPercent'	=> $thisPercent,
	'thisProcess'	=> $thisProcess,
	'tableDrop'		=> $tableDrop,
	'insertNow'		=> $insertNow,
	'thisClass'		=> $thisClass,
	'monitor'		=> 'synch',
);

echo json_encode($idArray);