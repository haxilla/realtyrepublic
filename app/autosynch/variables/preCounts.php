<?php

//synch log
Use App\models\synch\synchLog;

//namespace model
$prefix="App\autosynch\models\\$currentSynch\\";

//old & cur
$old=$currentSynch.'Old';
$cur=$currentSynch.'Cur';

//set model names
$oldModel=$prefix.$old;
$curModel=$prefix.$cur;

//get counts
$oldModelCount=$oldModel::count();
$curModelCount=$curModel::count();

//update
synchLog::where('synchID','=',"$synchID")
->update([
	"$old"			=> $oldModelCount,
	"$cur"			=> $curModelCount,
	"currentSynch"	=> $currentSynch
]);
