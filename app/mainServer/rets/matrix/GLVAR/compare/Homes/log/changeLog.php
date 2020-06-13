<?php

//update any matches
$matchThese = array('idMatrix' => $the->idMatrix);
//insert into table updateOrCreate


$changeLogModel::updateOrCreate($matchThese,[
	'logID'					=> $logID,
	'mlsName'				=> $mlsName,
	'idMatrix'				=> $the->idMatrix,
	'statusOld'				=> $the->statusOld,
	'statusNew'				=> $the->statusNew,
	'priceOld'				=> $the->priceOld,
	'priceNew'				=> $the->priceNew,
	'mlsNumber'				=> $the->mlsNum,
	'datemodMatrix'			=> $the->datemodMatrix,
	'changeType'			=> $changeType,
]);