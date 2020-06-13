<?php

Use App\adre\models\adreLog;

//default
$newLog=1;
$IndividualLog=1;
$EntityLog=1;

//find logs less than 24hrs ago
$lastLog=adreLog::select('logID','synchStart','synchEnd')
->orderBy('logID','desc')
->first();
//lastLog Variables
$lastEnd=$lastLog['synchEnd'];
$lastID=$lastLog['logID'];
//compare
$lastStart=$lastLog['synchStart'];
$now=\Carbon\Carbon::now();
//set diff
$diff=$lastStart->diffInHours($now);

// if last synch completed
// & it was less than 24hrs ago
// do not continue

if($lastEnd && $diff<23){
	echo "Too soon for update: ".$diff." Hours - Last LogID: ".$lastID;
	exit();}

//find any unfinished logs
$checkLog=adreLog::select('logID','IndividualEnd','EntityEnd')
->whereNotNull('synchStart')
->whereNull('synchEnd')
->first();

//dont start new
if($checkLog){
	// flag
	$newLog=null;
	// set logID
	$logID=$checkLog['logID']; 
	// check times
	$IndividualEnd=$checkLog['IndividualEnd'];
	$EntityEnd=$checkLog['EntityEnd'];
	//dont run if finished
	if($IndividualEnd){
		$IndividualLog=null;}
	if($EntityEnd){
		$EntityLog=null;}}

if($newLog){

	//start new
	$new=adreLog::create([
		'synchStart'=> \Carbon\Carbon::now(),	
		'inProgress'=> 1,
	]);

	//set logID
	$logID=$new['logID'];}