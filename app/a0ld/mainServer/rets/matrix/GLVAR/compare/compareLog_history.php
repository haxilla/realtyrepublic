<?php

$checkHistory=$historyLogModel::where('datemodMatrix','=',$the->datemodMatrix)
->where('idMatrix','=',$the->idMatrix)
->first();

if(!$checkHistory){
	$historyLogModel::create([
		'logID'			=> $logID,
		'mlsName'		=> $mlsName,
		'idMatrix'		=> $the->idMatrix,
		'datemodMatrix'	=> $the->datemodMatrix,
		'changeType'	=> $changeType,
	]);}