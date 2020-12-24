<?php

$thisProcess="Looping $retsLoop";

Use App\rets\models\retsLog;
retsLog::where('logID','=',$logID)
->update([
	'thisProcess'	=> $thisProcess,
	'thisLoop'		=> $retsLoop,
	'thisCount'		=> $loopCount,
	'thisTotal'		=> $thisTotal,
	'retsClass'		=> $retsClass,
]);

