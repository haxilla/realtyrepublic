<?php
//defaults
$redirect=null;
$reload=0;
// *********************************
// tasksection is where they want it
// listref is where it currently is
// *********************************
if($listRef=='devtask'){
	// devtask query
	$moveThis=devtask::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['taskDesc'];
}else if($listRef=='devexcuse'){
	// devexcuse query
	$moveThis=devexcuse::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['excuseDesc'];
}else if($listRef=='devtip'){
	// devtip query
	$moveThis=devtip::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['tipDesc'];
}else{
	// error if here
	dd('error-line27-tasksection.php');}

// set model
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

//section
if(!$oldSection){
	$oldSection="none";}
	
//type
if(!$taskType){
	$taskType="New";}