<?php

//model
Use App\rets\models\retsLog;

//check
$checkLog=retsLog::where('retsID','=',$retsID)
->whereNotNull('nextLoop')
->where('nextLoop','!=','Complete')
->first();

//if exists
if($checkLog){
	// set variables
	$logID=$checkLog['logID'];
	$nextLoop=$checkLog['nextLoop'];
	$retsClass=$checkLog['retsClass'];
	$retsLoop=$nextLoop;

//otherwise start new log
}else{
	
	//starting point
	$nextLoop='Homes_compareStart';
	$retsClass="Homes";
	//create query
	$new=retsLog::create([
		'retsID'			=> $retsID,
		'mlsName'			=> $mlsName,
		'nextLoop'			=> $nextLoop,
		'retsClass'			=> $retsClass,
	]);
	//set variables
	$logID=$new['logID'];
	$retsLoop=$nextLoop;
}