<?php

Use App\rets\models\retsLog;
Use App\rets\models\retsList;


$theStatus="Pending";
$compareEnd="$retsClass".'_compareEnd';
$thisProcess="$retsClass Ending Log ...";
$lastSynchDate=null;

//finds nextLoop and changes theStatus if complete
include(app_path()."/rets/$retsSystem/$mlsName/compare/variables/nextLoop.php");

//set log complete
retsLog::where('logID','=',$logID)
->update([
	'thisProcess'	=> $thisProcess,
	'retsClass'		=> $retsClass,
	"$compareEnd"	=> \Carbon\Carbon::now(),
	'nextLoop'		=> $nextLoop,]);

if($retsClass=='Complete'){

	//retsLog
	retsLog::where('logID','=',$logID)
	->update([
		'compareStageComplete'	=> \Carbon\Carbon::now(),
		'synchAllComplete' 		=> \Carbon\Carbon::now(),
		'nextSynch'		   		=> 'Complete',
		'thisProcess'			=> 'Complete',]);

	//query for value
	$getSynchDate=retsLog::where('logID','=',$logID)
	->select('synchDate','synchAllStart')
	->first();

	//lastSynchDate
	$lastSynchDate=$getSynchDate['synchAllStart'];
	$compareLoop=false;

	//retsList
	retsList::where('retsID','=',$retsID)
	->update([
		'lastSynchDate' => $lastSynchDate,
	]);}


if(!isset($cronJob)){
	//set array
	$idArray = array(
		'lastSynchDate'		=> $lastSynchDate,
		'thisProcess'		=> $thisProcess,
		'retsClass'			=> $retsClass,
		"theStatus"			=> $theStatus,
		"thisLoop"			=> $retsLoop,
		"nextLoop"			=> $nextLoop,);

	//echo json & exit
	echo json_encode($idArray);
	exit();}
