<?php

Use App\rets\models\retsLog;

//add counts to log
$homePriceCount=collect($homePrice)->count();
$homeStatusCount=collect($homeStatus)->count();
$homeNewCount=collect($homeNew)->count();
$homeRemoveCount=collect($homeRemoved)->count();

$newLog=retsLog::create([
	'synchDate'		=> \Carbon\Carbon::now(),
	'retsID'		=> $retsID,
	'mlsName'		=> $mlsName,
	'homePrice'		=> $homePriceCount,
	'homeStatus'	=> $homeStatusCount,
	'homeNew'		=> $homeNewCount,
	'homeRemoved'	=> $homeRemoveCount
]);

$logID=$newLog['logID'];