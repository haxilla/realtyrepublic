<?php

$homeChange='App\rets\models\\'.$mlsName.'_Homes_changelog';

//check URL variables
$lowerCount=request('lowerCount');
$raiseCount=request('raiseCount');
//lower & raise count defaults
if(!$lowerCount){
	$lowerCount=0;}
if(!$raiseCount){
	$raiseCount=0;}

$loopCount=0;
$thisTotal=$homePriceCount;
$retsClass="Homes";

//run loop
foreach($homePrice as $the){

	$loopCount++;

	//jquery log
	include(app_path()."/rets/$retsSystem/$mlsName/log/progressLogAjax.php");
	//changeType is Lowered or Raised
	if($the->priceOld > $the->priceNew){
		$changeType="Lowered";
		$lowerCount++;
	}else{
		$changeType="Raised";
		$raiseCount++;}

	include(app_path()."/rets/$retsSystem/$mlsName/log/historyLog.php");

	//update any matches
	$matchThese = array('idMatrix' =>$the->idmatrixOld);
	//insert into table updateOrCreate
	$homeChange::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'idMatrix'		=>$the->idmatrixOld,
		'priceOld'		=>$the->priceOld,
		'priceNew'		=>$the->priceNew,
		'mlsNumber'		=>$the->mlsNumOld,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,
	]);
}
