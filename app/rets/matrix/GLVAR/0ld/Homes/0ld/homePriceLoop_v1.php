<?php

$homeChange='App\rets\models\\'.$mlsName.'homes_changelog';

//check URL variables
$lowerCount=request('lowerCount');
$raiseCount=request('raiseCount');
//lower & raise count defaults
if(!$lowerCount){
	$lowerCount=0;}
if(!$raiseCount){
	$raiseCount=0;}

$incomplete=null;
$loopCount=0;
$thisTotal=$homePriceCount;

//run loop
foreach($homePrice as $the){
	//set to check if inside loop
	$incomplete=1;
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

if(!$incomplete){

	include(app_path()."/rets/$retsSystem/$mlsName/log/synchOrder.php");
	
	//set log complete
	retsLog::where('logID','=',$logID)
	->update([
		'nextLoop'			=> $nextLoop,]);

	//set array
	$idArray = array(
		"status"		=> 'In Progress',
		"thisLoop"		=> $retsLoop,
		"nextLoop"		=> 'homeStatus');
	
	//echo json & exit
	echo json_encode($idArray);
	exit();}
