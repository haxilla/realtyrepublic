<?php

//model
Use App\rets\models\retsLog;
//default status
$theStatus="Pending";
$thisProcess="End of $retsClass - $retsLoop";
//finds nextLoop and changes status if complete
include(app_path()."/rets/$retsSystem/$mlsName/compare/variables/nextLoop.php");

//set log complete
retsLog::where('logID','=',$logID)
->update([
	'retsClass'				=> $retsClass,
	'thisCount'				=> 0,
	'thisLoop'				=> null,
	'thisTotal'				=> 0,
	"$totalCountVar"		=> $thisTotal,
	'thisProcess'			=> $thisProcess,
	'nextLoop'				=> $nextLoop,
]);

//homePrice
if($retsLoop=='homePrice'){
	retsLog::where('logID','=',$logID)
	->update([
		'lowerCount'		=> $lowerCount,
		'raiseCount'		=> $raiseCount,
	]);}

//homeStatus
if($retsLoop=='homeStatus'){
	retsLog::where('logID','=',$logID)
	->update([
		'backOnMarketCount'		=> $backOnMarketCount,
		'underContractCount'	=> $underContractCount,
		'closedLeaseCount'		=> $closedLeaseCount,
		'closedSaleCount'		=> $closedSaleCount,
		'historyCount'			=> $historyCount,
		'otherStatusCount'		=> $otherStatusCount,
	]);}

if(!isset($cronJob)){
	//set array
	$idArray = array(
		'thisProcess'		=> $thisProcess,
		"retsClass"			=> $retsClass,
		"theStatus"			=> $theStatus,
		"$totalCountVar"	=> $thisTotal,
		"thisLoop"			=> $retsLoop,
		"nextLoop"			=> $nextLoop,);

	//echo json & exit
	echo json_encode($idArray);
	exit();}
