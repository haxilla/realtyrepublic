<?php

Use App\rets\models\retsLog;

$changeLog='App\rets\models\\'.$mlsName.'_Homes_changelog';
$changeType="Removed";
//jquery
$loopCount=0;
$thisTotal=$homeRemovedCount;
$retsClass="Homes";

//run loop
foreach($homeRemoved as $the){
	//increment
	$loopCount++;
	//jquery log
	include(app_path()."/rets/$retsSystem/$mlsName/log/progressLogAjax.php");
	//history
	@include(app_path()."/rets/$retsSystem/$mlsName/log/historyLog.php");

	//update any matches
	$matchThese = array('idMatrix' =>$the->idmatrixOld);

	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'idMatrix'		=>$the->idmatrixOld,
		'mlsNumber'		=>$the->mlsNumOld,
		'statusOld'		=>$the->statusOld,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}
