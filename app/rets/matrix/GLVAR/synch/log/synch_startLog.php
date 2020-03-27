<?php

//model
Use App\rets\models\retsLog;

//set synchStart Variable
$synchStartVar=$thisSynch.'_synchStart';
$thisProcess="Starting $thisSynch...";

//update log
retsLog::where('logID','=',$logID)
->update([

	"$synchStartVar"		=> \Carbon\Carbon::now(),
	'thisProcess'			=> $thisProcess,

]);