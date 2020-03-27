<?php

//model
use App\models\synch\synchLog;

//look for unfinished log
$pendingSynch=synchLog::select(
	'synchID','nextSynch','synchStart'
)->whereNotNull('synchStart')
->whereNull('synchComplete')
->first();

//if no pending log start new
if(!$pendingSynch){

	//phoenix time
	$synchStartPhx=$now
	->setTimezone(new DateTimeZone('America/Phoenix'));
	$next='new';

//resume incomplete synch
}else{

	$synchID=$pendingSynch['synchID'];
	$next=$pendingSynch['nextSynch'];
	$synchStart=$pendingSynch['synchStart'];
	//show Phx time
	$synchStartPhx=$synchStart
	->setTimezone(new DateTimeZone('America/Phoenix'));
}
