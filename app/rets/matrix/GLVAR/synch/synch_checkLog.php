<?php

//model
Use App\rets\models\retsLog;

//check
$checkLog=retsLog::where('retsID','=',$retsID)
->whereNotNull('synchAllStart')
->whereNull('synchAllComplete')
->orWhere(function($q){
	$q->whereNull('synchStageComplete')
	  ->orWhere('nextSynch','=','Compare');
})->first();

//if exists
if($checkLog){
	// set variables
	$logID=$checkLog['logID'];
	$thisSynch=$checkLog['nextSynch'];

//otherwise start new log
}else{
	//starting point
	$thisSynch='synchStart';
	$nextSynch='Homes';
	//create query
	// synchStart
	$new=retsLog::create([
		'synchAllStart'		=> \Carbon\Carbon::now(),
		'retsID'			=> $retsID,
		'mlsName'			=> $mlsName,
		'nextSynch'			=> $nextSynch,
	]);
	//set variables
	$logID=$new['logID'];}

if(!$logID){
	echo "NO LOG ID!";
	exit();}