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
	'retsClass'			=> $retsClass,
	"$totalCountVar"	=> $thisTotal,
	'thisCount'			=> 0,
	'thisLoop'			=> null,
	'nextLoop'			=> $nextLoop,]);

//set array
$idArray = array(
	"theStatus"			=> $theStatus,
	"$totalCountVar"	=> $thisTotal,
	"thisLoop"			=> $retsLoop,
	"nextLoop"			=> $nextLoop,
	"retsClass"			=> $retsClass);

//echo json & exit
echo json_encode($idArray);
exit();