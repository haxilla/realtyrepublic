<?php

Use App\rets\models\retsLog;

$changeLog='App\rets\models\\'.$mlsName.'homes_changelog';
$changeType="Removed";

//run loop
foreach($homeRemoved as $the){

	//history
	@include("homeHistory.php");

	//update any matches
	$matchThese = array('matrixID' =>$the->idmatrixOld);

	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'matrixID'		=>$the->idmatrixOld,
		'mlsNumber'		=>$the->mlsNumOld,
		'statusOld'		=>$the->statusOld,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}
