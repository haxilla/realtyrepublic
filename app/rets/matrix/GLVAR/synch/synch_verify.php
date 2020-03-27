<?php

//model
Use App\rets\models\retsLog;

//count records in local database
$newCount=$mainModel::count();
$newCountVar=$thisSynch.'_'.'recordCount';

// if counts do not match 
// send notice & error out
if($newCount < $retsTotalCount){
	//send admin notice

	//error
	dd("error-line11-synch_verify.php - $newCount / $retsTotalCount");}

$thisProcess="$thisSynch Verified...";

//run update
retsLog::where('logID','=',$logID)
->update([
	"$newCountVar"	=> $newCount,
	'thisProcess'	=> $thisProcess,
]);