<?php 

//model
Use App\rets\models\retsLog;

//run update
retsLog::where('logID','=',$logID)
->update([

	'thisCount' => $cumulativeResult,
	'thisTotal'	=> $retsTotalCount,

]);