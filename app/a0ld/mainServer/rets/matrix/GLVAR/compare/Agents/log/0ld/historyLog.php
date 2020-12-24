<?php

//query
$checkHistory=$historyLogModel::where('datemodMatrix','=',$datemodMatrix)
->where('idMatrix','=',$idMatrix)
->first();

if(!$checkHistory){
	$historyLogModel::create([
		'logID'			=> $logID,
		'idMatrix'		=> $idMatrix,
		'mlsName'		=> $mlsName,
		'datemodMatrix'	=> $datemodMatrix,
		'changeType'	=> $changeType,
	]);}