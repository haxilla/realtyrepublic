<?php

//model
Use App\rets\models\retsLog;
$thisProcess="$thisSynch - End Log";

//used to mark end of synch class
$synchVar=$thisSynch.'_synchEnd';
$nextLoop=null;
$retsClass=null;
//if its just starting set synchDate
if($thisSynch=='synchStart'){
	$synchVar='synchDate';}

if($thisSynch=='synchEnd'){
	$synchVar='synchStageComplete';
	$nextLoop='Homes_compareStart';
	$thisProcess="Synch ALL Complete!";
	$retsClass='Homes';
	$synchLoop=false;}

//update log
retsLog::where('logID','=',$logID)
->update([
	'nextSynch' 			=> $nextSynch,
	"$synchVar"				=> \Carbon\Carbon::now(),
	'nextLoop'				=> $nextLoop,
	'retsClass'				=> $retsClass,
	'thisProcess'			=> $thisProcess,
	'tableDrop'				=> NULL,
	'insertNow'				=> NULL,
]);

//if its not a cronjob then return json
if(!isset($cronJob)){
	//returns logID, nextSynch & status
	$idArray=array(
		'theStatus'	=> $theStatus,
		'logID'		=> $logID,
		'retsID'	=> $retsID,
		'thisSynch'	=> $thisSynch,
		'nextSynch'	=> $nextSynch,
	);

	//send reply & exit
	echo json_encode($idArray);
	exit();}

if(isset($cronJob) && 
$thisSynch=='synchStart'){
	$thisSynch='Homes';
	$searchResource="Property";
	$searchClass="Listing";}

if(isset($cronJob) && 
$thisSynch=='synchEnd'){
	$thisSynch='Compare';
	$synchLoop=false;}
