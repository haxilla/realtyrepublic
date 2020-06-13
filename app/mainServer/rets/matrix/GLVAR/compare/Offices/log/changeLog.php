<?php

$matchThese = array('idMatrix' =>$the->idMatrix);
//insert into table updateOrCreate
$changeLogModel::updateOrCreate($matchThese,[
	'logID'			 	=>	$logID,
	'mlsName'		 	=>	$mlsName,
	'idMatrix'		 	=>	$the->idMatrix,
	'datemodMatrix'	 	=>	$the->datemodMatrix,
	'changeType'	 	=>	$changeType,
	'officeName'	 	=> 	$the->officeName,
	'officeMLSID'	 	=> 	$the->officeMLSID,
	'statusNew'			=>	$the->statusNew,
	'statusOld'			=> 	$the->statusOld,
	'DBrokerOld'		=> 	$the->DBrokerOld,
	'DBrokerNew'		=> 	$the->DBrokerNew,
	'officeAddressOld'	=> 	$the->officeAddressOld,
	'officeAddressNew'	=> 	$the->officeAddressNew,
	'officeCityOld'		=> 	$the->officeCityOld,
	'officeCityNew'		=> 	$the->officeCityNew,
	'officeStateOld'	=> 	$the->officeStateOld,
	'officeStateNew'	=> 	$the->officeStateNew,
	'officeZipOld'		=> 	$the->officeZipOld,
	'officeZipNew'		=> 	$the->officeZipNew
]);