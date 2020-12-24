<?php

$matchThese = array('idMatrix' =>$the->idMatrix);
//insert into table updateOrCreate
$changeLogModel::updateOrCreate($matchThese,[
	'logID'			 =>	$logID,
	'mlsName'		 =>	$mlsName,
	'idMatrix'		 =>	$the->idMatrix,
	'datemodMatrix'	 =>	$the->datemodMatrix,
	'changeType'	 =>	$changeType,
	'firstName'		 =>	$the->firstName,
	'lastName'		 =>	$the->lastName,
	'fullName'		 =>	$the->fullName,
	'agentEmailNew'	 => $the->agentEmailNew,
	'agentEmailOld'	 => $the->agentEmailOld,
	'licenseNumber'	 =>	$the->licenseNumber,
	'officeMLSIDNew' => $the->officeMLSIDNew,
	'officeMLSIDOld' => $the->officeMLSIDOld,
	'officeMatrixNew'=>	$the->officeMatrixNew,
	'officeMatrixOld'=>	$the->officeMatrixOld,
	'mlsID'			 =>	$the->mlsID,
	'statusNew'		 =>	$the->statusNew,
	'statusOld'		 => $the->statusOld,
	'agentType'		 =>	$the->agentType,
]);