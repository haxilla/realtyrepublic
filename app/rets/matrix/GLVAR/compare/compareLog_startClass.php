<?php 

Use App\rets\models\retsLog;

$theStatus="Pending";
$compareStart="$retsClass".'_compareStart';
$thisProcess="Starting log on $retsClass ...";
//finds nextLoop and changes theStatus if complete
include(app_path()."/rets/$retsSystem/$mlsName/compare/variables/nextLoop.php");
//set log complete
retsLog::where('logID','=',$logID)
->update([
	'retsClass'		=> $retsClass,
	"$compareStart"	=> \Carbon\Carbon::now(),
	'thisProcess'	=> $thisProcess,
	'nextLoop'		=> $nextLoop,]);

if(!isset($cronJob)){
	//set array
	$idArray = array(
		"theStatus"			=> $theStatus,
		"thisProcess"		=> $thisProcess,
		"thisLoop"			=> $retsLoop,
		"nextLoop"			=> $nextLoop,);

	//echo json & exit
	echo json_encode($idArray);
	exit();}

