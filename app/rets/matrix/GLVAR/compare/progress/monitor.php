<?php

Use App\rets\models\retsLog;

//check URL
$logID=request('logID');

if(!$logID){
	include("getLogID.php");}

if(!$logID){
	dd("error-line12-$mlsName/compare/progress/monitor.php");}

//query log
$getLog=retsLog::where('logID','=',$logID)
->first();

$theStatus='Pending';
$thisLoop=$getLog['thisLoop'];
$nextLoop=$getLog['nextLoop'];
$thisCount=$getLog['thisCount'];
$thisTotal=$getLog['thisTotal'];
$thisClass=$getLog['retsClass'];
$thisProcess=$getLog['thisProcess'];

//set status
if($nextLoop=='Complete'){
	$theStatus='Complete';}

//set percentage
$thisPercent=0;
//calculate when possible
if($thisCount>0 && $thisTotal>0){
	$thisPercent=$thisCount/$thisTotal*100;
	$thisPercent=round($thisPercent,2);}

//return json & exit
$idArray = array(
	'theStatus'		=> $theStatus,
	'retsID'		=> $retsID,
	'logID'			=> $logID,
	'thisLoop'		=> $thisLoop,
	'nextLoop'		=> $nextLoop,
	'thisCount'		=> $thisCount,
	'thisTotal'		=> $thisTotal,
	'thisPercent'	=> $thisPercent,
	'thisClass'		=> $thisClass,
	'thisProcess'	=> $thisProcess,
	'monitor'		=> "compare",
);

echo json_encode($idArray);
exit();


