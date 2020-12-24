<?php

//models
Use App\rets\models\retsList;
Use App\rets\models\retsLog;

//time in UTC
$hoursAgo3=\Carbon\Carbon::now()->subMinutes(210);
$minutesAgo15=\Carbon\Carbon::now()->subMinutes(15);

//get lastSynchDate
$getRets=retsList::where('lastSynchDate','<',$hoursAgo3)
->orderBy('lastSynchDate')
->first();

//if none - no synch needed
if(!$getRets){
	echo "NO SYNCHS NEEDED";
	exit();}

//set rets ID;
$retsID=$getRets['retsID'];
//error if no retsID
if(!$retsID){
	echo "NO RETS ID!";
	exit();}

//set variables
$retsSystem=$getRets['retsSystem'];
$mlsName=$getRets['mlsName'];

//check
$checkLog=retsLog::where('retsID','=',$retsID)
->whereNotNull('synchAllStart')
->whereNull('synchAllComplete')
->orWhere(function($q){
	$q->whereNull('synchStageComplete')
	  ->orWhere('nextSynch','=','Compare');
})->first();

//if log exists
if($checkLog){
	// set variables
	$thisSynch=$checkLog['nextSynch'];
	$thisCompare=$checkLog['nextLoop'];
	// if conditions
	// synch
	if($thisSynch=='Compare'){
		$synchLoop=false;}
	// compare
	if($thisCompare=='Complete'){
		$compareLoop=false;}}
