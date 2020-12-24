<?php 

Use App\rets\models\retsLog;

$theStatus="Pending";
//finds nextLoop and changes theStatus if complete
include(app_path()."/rets/$retsSystem/$mlsName/compare/variables/nextLoop.php");
//set log complete
retsLog::where('logID','=',$logID)
->update([
	'agentSynchStart'	=> \Carbon\Carbon::now(),
	'nextLoop'			=> $nextLoop,]);

//set array
$idArray = array(
	"theStatus"			=> $theStatus,
	"thisLoop"			=> $retsLoop,
	"nextLoop"			=> $nextLoop,);

//echo json & exit
echo json_encode($idArray);
exit();

