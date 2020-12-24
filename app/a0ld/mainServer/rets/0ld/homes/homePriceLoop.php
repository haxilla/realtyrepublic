<?php

Use App\rets\models\retsLog;
$homeChange='App\rets\models\\'.$mlsName.'homes_changelog';

$lowerCount=0;
$raiseCount=0;
//run loop
foreach($homePrice as $the){
	//changeType is Lowered or Raised
	if($the->priceOld > $the->priceNew){
		$changeType="Lowered";
		$lowerCount++;
	}else{
		$changeType="Raised";
		$raiseCount++;}

	include('homeHistory.php');

	//update any matches
	$matchThese = array('matrixID' =>$the->idmatrixOld);
	//insert into table updateOrCreate
	$homeChange::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'matrixID'		=>$the->idmatrixOld,
		'priceOld'		=>$the->priceOld,
		'priceNew'		=>$the->priceNew,
		'mlsNumber'		=>$the->mlsNumOld,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}

retsLog::where('logID','=',$logID)
->update([
	'justLowered'	=> $lowerCount,
	'justRaised'	=> $raiseCount,
]);