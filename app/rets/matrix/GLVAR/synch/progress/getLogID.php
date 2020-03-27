<?php

Use App\rets\models\retsLog;

//get logID
$checkLog=retsLog::where('retsID','=',$retsID)
->whereNotNull('synchDate')
->whereNull('synchStageComplete')
->first();

//show process as pending if none
if(!$checkLog){
	//show status & exit
	$idArray=array(
		'Status'	=> 'Pending logID',);

	echo json_encode($idArray);
	exit();}

//set logID
$logID=$checkLog['logID'];