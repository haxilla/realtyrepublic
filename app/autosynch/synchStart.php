<?php

//check url variables
$synchType=request('synchType');
$currentSynch=request('currentSynch');

//error if none
if(!$synchType||!$currentSynch){
	dd('error-line9-synchStart.php');}

// sets synchID & status
// 'new' or 'resume'
include('log/startLog.php');

//synchOne or synchAll
if($synchType=='synchOne'
&& $status=='resume'){

	include('synchTable.php');

}elseif($synchType=='synchAll'){

	//this finds next synch variable
	include('variables/findNext.php');
	//only start synch in resume status
	if($status=='resume'){
		include('synchTable.php');
	}elseif($status=='complete'){
		include('log/completeLog.php');
	}elseif($status!="new"){
		dd('error-line32-synchStart.php'." $status");}

}elseif($status!="new"){
	dd('error-line36-synchStart.php'." $synchType $status");}

//output json & exit
$idArray = array(
  'status'          => $status,
  'synchID'         => $synchID,
  'synchType'	 			=> $synchType,
  'currentSynch' 		=> $currentSynch,
  'page'						=> 'synchStart'
);

echo json_encode($idArray);
exit();
