<?php


Use App\rets\models\retsLog;
$changeLog='App\rets\models\\'.$mlsName.'_Homes_changelog';

//variables
$backOnMarket=0;
$underContract=0;
$closedSale=0;
$closedLease=0;
$otherStatus=0;
$history=0;
$changeType='status';
$loopCount=0;

//run loop
foreach($homeStatus as $the){

	$loopCount++;
	//jquery log
	include(app_path()."/rets/$retsSystem/$mlsName/log/progressLogAjax.php");

	//back on market
	if(strpos($the->statusOld,'Under')!==false 
	&& strpos($the->statusNew,'Active')!==false){
		$backOnMarket++;
		$newStatus='backOnMarket';
	//under contract
	}else if(strpos($the->statusOld,'Active')!==false 
	&& strpos($the->statusNew,'Under')!==false){
		$underContract++;
		$newStatus='underContract';
	// changed from undercontract-show 
	// to undercontract-noshow
	}elseif(strpos($the->statusNew,'Under')!==false){
		$underContract++;
		$newStatus='underContract';
	//closed sale
	}elseif(strpos($the->statusNew,'Sold')!==false){
		$closedSale++;
		$newStatus='sold';
	//closed lease
	}elseif(strpos($the->statusNew,'Leased')!==false){
		$closedLease++;
		$newStatus='leased';
	}elseif(strpos($the->statusNew,'History')!==false){
		$history++;
		$newStatus='history';
	}else{
		$otherStatus++;}

	//history
	@include(app_path()."/rets/$retsSystem/$mlsName/log/historyLog.php");

	//update any matches
	$matchThese = array('idMatrix' =>$the->idmatrixOld);

	//insert into table updateOrCreate
	$changeLog::updateOrCreate($matchThese,[
		'logID'			=>$logID,
		'mlsName'		=>$mlsName,
		'idMatrix'		=>$the->idmatrixOld,
		'statusOld'		=>$the->statusOld,
		'statusNew'		=>$the->statusNew,
		'mlsNumber'		=>$the->mlsNumOld,
		'datemodMatrix'	=>$the->datemodMatrix,
		'changeType'	=>$changeType,]);
}//end of foreach loop