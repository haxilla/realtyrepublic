<?php

Use App\adre\models\adreLog;

// error if none
if(!$logID){
	dd('error-line7-adre/puppeteer/logs/thisComplete.php');}

// default
$synchEnd=null;
$inprogress=1;

// set synchEnd if lastLog
if($lastLog){
	$synchEnd=\Carbon\Carbon::now();
	$inprogress=null;}

// update log
adreLog::where('logID','=',$logID)
->update([
	$thisComplete 	=> \Carbon\Carbon::now(),
	'synchEnd'		=> $synchEnd,
	'inprogress'	=> $inprogress,
]);