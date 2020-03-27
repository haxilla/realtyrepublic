<?php

//model
Use App\rets\models\retsLog;

//set variable
$retsTotalVar=$thisSynch.'_retsTotal';

//run update
retsLog::where('logID','=',$logID)
->update([
	"$retsTotalVar" => $retsTotalCount
]);

