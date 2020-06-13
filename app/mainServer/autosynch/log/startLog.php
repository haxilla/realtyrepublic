<?php

//model
Use App\models\synch\synchLog;

// Check synchLog for any incomplete logs for $next
// $next is synchOne or synchAll
$checkSynch=synchLog::where('synchType','=',$synchType)
->whereNotNull('synchStart')
->whereNull('synchComplete');

//synchType
if($checkSynch && $synchType=='synchOne'){
	$checkSynch=$checkSynch
	->where('currentSynch','=',"$currentSynch")
	->first();
}else{
	$checkSynch=$checkSynch->first();}

// if found resume
if($checkSynch){

	//get synchID
	$synchID=$checkSynch['synchID'];
	$status="resume";

// otherwise create record
}else{

	//insert new
	$synchLog=synchLog::create([
		'currentSynch'	=> $currentSynch,
		'synchType'		=> $synchType,
		'synchStart'	=> \Carbon\Carbon::now(),
	]);

	//get synchID
	$synchID=$synchLog['synchID'];
	$status="new";

}