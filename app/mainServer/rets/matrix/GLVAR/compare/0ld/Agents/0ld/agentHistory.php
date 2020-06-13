<?php

//set model
$theHistory='App\rets\models\\'.$mlsName.'_'.$retsClass.'_history';

$checkHistory=$theHistory::where('datemodMatrix','=',$the->datemodMatrix)
->first();

if(!$checkHistory){
	$agentHistory::create([
		'logID'			=> $logID,
		'mlsName'		=> $mlsName,
		'mlsNumber'		=> $mlsNumber,
		'matrixID'		=> $idMatrix,
		'datemodMatrix'	=> $the->datemodMatrix,
		'changeType'	=> $changeType,
		'currentPrice'	=> $currentPrice,
		'currentStatus'	=> $currentStatus,
	]);}