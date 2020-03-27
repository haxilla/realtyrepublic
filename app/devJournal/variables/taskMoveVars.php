<?php
// set model
$thisModel="App\devJournal\models\\$listRef";

// run query
$taskMove=$thisModel::where('taskID','=',$taskID)
->first();
// set variables
$created_at=$taskMove['created_at'];
$updated_at=$taskMove['updated_at'];
$stickyDate=$taskMove['stickyDate'];
// core values
$authLevel=$taskMove['authLevel'];
$lastComment=$taskMove['lastComment'];
$taskComplete=$taskMove['taskComplete'];
$taskType=$taskMove['taskType'];
$versionID=$taskMove['versionID'];
// misc
$oldAdminID=$taskMove['adminID'];
$oldTaskStatus=$taskMove['taskStatus'];
$oldSection=$taskMove['taskSection'];
//section
if(!$oldSection){
	$oldSection="none";}

// listRef where it came from
if($listRef=='devtip'){
	$theDesc=$taskMove['tipDesc'];
}elseif($listRef=='devexcuse'){
	$theDesc=$taskMove['excuseDesc'];
}elseif($listRef=='devtask'){
	$theDesc=$taskMove['taskDesc'];
}else{
	dd('error-line33-taskMoveVars.php');}

// taskSection where they want it
if($taskSection=="Tip"){
	$redirect="Tip";
	$taskModel="devtip";
	$desc='tipDesc';
}elseif($taskSection=="Excuse"){
	$redirect="Excuse";
	$taskModel="devexcuse";
	$desc='excuseDesc';
}else{
	$redirect="Task";
	$taskModel="devtask";
	$desc="taskDesc";}

if(!$theDesc){
	dd($taskMove,$taskModel,'error-line44-taskMoveVars.php');}

// Set taskType **
$taskType=$taskSection;
// Change if devtask
if($taskModel=='devtask'){
	$taskType='Core';}