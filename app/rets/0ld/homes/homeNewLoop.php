<?php

Use App\rets\models\retsLog;
$changeLog='App\rets\models\\'.$mlsName.'homes_changelog';
$changeType='New Listing';

//run loop
foreach($homeNew as $the){

	//history
	@include("homeHistory.php");

	//update any matches
	$matchThese = array('matrixID' =>$the->idmatrixNew);

	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'matrixID'		=>$the->idmatrixNew,
		'mlsNumber'		=>$the->mlsNumNew,
		'priceNew'		=>$the->priceNew,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}
