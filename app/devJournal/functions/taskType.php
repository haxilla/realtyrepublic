<?php

// variable models
if($listRef=='devtask'){
	$theModel='App\devJournal\models\devtask';
}elseif($listRef=='devtip'){
	$theModel='App\devJournal\models\devtip';
}elseif($lifRef=='devexcuse'){
	$theModel='App\devJournal\models\devexcuse';
}else{
	dd('error-line12-taskType.php');}

// query for oldTaskType
$oldTaskQuery=$theModel::where('taskID','=',$taskID)
->select('taskType','created_at')
->first();
// set vars
$oldTaskType=$oldTaskQuery['taskType'];
$taskCreated=$oldTaskQuery['created_at'];

// set timeframes
$now=\Carbon\Carbon::now();
$fewDaysAgo=$now->subDays('3');
//compare
$newEntry=0;
if($fewDaysAgo < $taskCreated){
	$newEntry=1;}

//default oldBadge
$oldBadge="taskBadge".$oldTaskType;
//change for Null
if(!$oldTaskType){
	//set value
	$oldTaskType="Null";
	//set oldBadge
	if($newEntry){
		$oldBadge="taskBadgeNew";
	}else{
		$oldBadge="taskBadgeNone";}}

// default taskTypeDisplay
$taskTypeDisplay=$taskType;
// default newBadge
$newBadge="taskBadge".$taskType;
// change for Clear
if($taskType=="Clear"){
	$taskTypeDisplay="Null";
	$taskType=null;
	//set newBadge
	if($newEntry){
		$newBadge="taskBadgeNew";
	}else{
		$newBadge="taskBadgeNone";}}

// update model
$theModel::where('taskID','=',$taskID)
->update([
	'taskType'		=> $taskType,
	'lastEdit'		=> \Carbon\Carbon::now(),
	'editType'		=> "Type Changed from $oldTaskType to $taskTypeDisplay",
	'editBy'		=> $adminID,
]);

//output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'tasktype',
	'oldBadge'		=> $oldBadge,
	'newBadge'		=> $newBadge,
	'tasktype'		=> $taskType,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();