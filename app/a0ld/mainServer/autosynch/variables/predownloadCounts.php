<?php

//synch log
Use App\models\synch\synchLog;

$column=$currentSynch.'Old';

$addCounts=synchLog::where('synchID','=',"$synchID")
->whereNull($column)
->first();

if($addCounts){

	$theModel="App\autosynch\models\\downloads\\$currentSynch";
	$theCount=$theModel::downloadCount();

	//update
	synchLog::where('synchID','=',"$synchID")
	->update([
		"$column"		=> $theCount,
		"currentSynch"	=> $currentSynch
	]);
}



