<?php

//model
Use App\rets\models\retsLog;
//default status
$theStatus="Pending";
//finds nextLoop and changes status if complete
include(app_path()."/rets/$retsSystem/$mlsName/log/nextLoop.php");
//set log complete
retsLog::where('logID','=',$logID)
->update([
	'retsClass'				=> $retsClass,
	'thisCount'				=> 0,
	'thisLoop'				=> null,
	'backOnMarketCount'		=> $backOnMarket,
	'underContractCount'	=> $underContract,
	'closedLeaseCount'		=> $closedLease,
	'closedSaleCount'		=> $closedSale,
	'historyCount'			=> $history,
	'otherStatusCount'		=> $otherStatus,
	"$totalCountVar"		=> $thisTotal,
	'nextLoop'				=> $nextLoop,
]);

//set array
$idArray = array(
	"retsClass"			=> $retsClass,
	"theStatus"			=> $theStatus,
	"$totalCountVar"	=> $thisTotal,
	"thisLoop"			=> $retsLoop,
	"nextLoop"			=> $nextLoop,);

//echo json & exit
echo json_encode($idArray);
exit();


