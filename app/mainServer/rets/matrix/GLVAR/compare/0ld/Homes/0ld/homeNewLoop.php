<?php

Use App\rets\models\retsLog;
$changeLog='App\rets\models\\'.$mlsName.'_Homes_changelog';
$changeType='New Listing';

//jquery
$loopCount=0;
$thisTotal=$homeNewCount;
$retsClass='Homes';

//run loop
foreach($homeNew as $the){
	//increment
	$loopCount++;
	//jquery log
	include(app_path()."/rets/$retsSystem/$mlsName/log/progressLogAjax.php");
	//history
	@include(app_path()."/rets/$retsSystem/$mlsName/log/historyLog.php");
	//update any matches
	$matchThese = array('idMatrix' =>$the->idmatrixNew);

	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'idMatrix'		=>$the->idmatrixNew,
		'mlsNumber'		=>$the->mlsNumNew,
		'priceNew'		=>$the->priceNew,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}
