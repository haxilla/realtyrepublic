<?php

Use App\rets\models\retsLog;

retsLog::where('logID','=',"$logID")
->update([
	'thisProcess'	=> $thisProcess,
	'thisModel'		=> $thisModel,
	'thisTotal'		=> $thisTotal,
	'insertNow'		=> $insertNow,
	'tableDrop'		=> NULL,
]);