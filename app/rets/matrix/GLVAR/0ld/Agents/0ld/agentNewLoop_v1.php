<?php

Use App\rets\models\retsLog;

$retsClass='Agents';
$changeLog='App\rets\models\\'.$mlsName.'_'.$retsClass.'_changelog';
$changeType='New Agents';
//jquery
$loopCount=0;
$thisTotal=$agentNewCount;
//run loop
foreach($agentNew as $the){
	//increment
	$loopCount++;
	//set idMatrix
	$idMatrix=$the->idmatrixNew;
	if(!$idMatrix){
		$idMatrix=$the->idmatrixOld;}
	if(!$idMatrix){
		dd('error-line19-agentNewLoop.php');}
		
	//jquery log
	include(app_path()."/rets/$retsSystem/$mlsName/log/progressLogAjax.php");
	//history
	@include(app_path()."/rets/$retsSystem/$mlsName/log/historyLog.php");
	//update any matches
	$matchThese = array('idMatrix' =>$idMatrix);
	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>	$logID,
		'mlsName'		=>	$mlsName,
		'idMatrix'		=>	$idMatrix,
		'datemodMatrix'	=>	$the->datemodMatrix,
		'changeType'	=>	$changeType,
		'firstName'		=>	$the->firstName,
		'lastName'		=>	$the->lastName,
		'fullName'		=>	$the->fullName,
		'agentEmail'	=> 	$the->agentEmail,
		'licenseNumber'	=>	$the->licenseNumber,
		'officeMLSID'	=> 	$the->officeMLSID,
		'officeMatrix'	=>	$the->officeMatrix,
		'mlsID'			=>	$the->mlsID,
		'agentStatus'	=>	$the->agentStatus,
		'agentType'		=>	$the->agentType,
	]);
}
