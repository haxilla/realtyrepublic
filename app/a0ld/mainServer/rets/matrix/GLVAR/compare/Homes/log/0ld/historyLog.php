
<?php

$checkHistory=$historyLogModel::where('datemodMatrix','=',$datemodMatrix)
->where('idMatrix','=',$idMatrix)
->first();

if(!$checkHistory){
	$historyLogModel::create([
		'logID'			=> $logID,
		'mlsName'		=> $mlsName,
		'mlsNumber'		=> $mlsNumber,
		'idMatrix'		=> $idMatrix,
		'datemodMatrix'	=> $datemodMatrix,
		'changeType'	=> $retsLoop,
		'currentPrice'	=> $currentPrice,
		'currentStatus'	=> $currentStatus,
	]);}