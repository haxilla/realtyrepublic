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
	'thisCount'			=> 0,
	'thisLoop'			=> null,
	"$totalCountVar"	=> $thisTotal,
	'lowerCount'		=> $lowerCount,
	'raiseCount'		=> $raiseCount,
	'nextLoop'			=> $nextLoop,]);

//set array
$idArray = array(
	"theStatus"			=> $theStatus,
	"$totalCountVar"	=> $thisTotal,
	"retsClass"			=> $retsClass,
	"thisLoop"			=> $retsLoop,
	"nextLoop"			=> $nextLoop,);

//echo json & exit
echo json_encode($idArray);
exit();