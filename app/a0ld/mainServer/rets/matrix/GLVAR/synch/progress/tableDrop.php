<?php

Use App\rets\models\retsLog;

retsLog::where('logID','=',"$logID")
->update([
	'thisProcess'	=> $thisProcess,
	'tableDrop'		=> $tableDrop,
	'insertNow'		=> null,
	'thisCount'		=> null,
	'thisTotal'		=> null,
]);