<?php

// ******
// models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;

// *********************
// include variables
// sets redirect if any
// *********************
include(app_path().'/devJournal/variables/taskSectionVars.php');

// ****************************************
// going IN OR OUT of devtip or devexuse
// when listRef & taskSection are not equal
// ****************************************
if(($taskSection=='Tip' && $listRef != "devtip")||
($taskSection=='Excuse' && $listRef != "devexcuse")||
($listRef=='devtip' && $taskModel != "devtip")||
($listRef=='devexcuse' && $taskModel != "devexcuse")){

	// ** Set taskType **
	// start equal
	$taskType=$taskSection;
	// change if devtask
	if($taskModel=='devtask'){
		$taskType='Core';}

	// set to refresh
	$reload=1;
	// taskMove.php requires 
	// $listRef & $taskModel
	include('taskMove.php');}


// **********************************
// when tip or excuse is not involved 
// just update devtask
// **********************************
if(($taskSection!="Tip" && $taskSection!="Excuse"
&& $listRef!="devtip" && $listRef!="devexcuse")){
	//check if exists
	$exists=devtask::where('taskID','=',$taskID)
	->first();
	//error if none
	if(!$exists){
		dd('error-line87-taskSection');}
	//update
	devtask::where('taskID','=',$taskID)
	->update([
		'taskSection'	=> $taskSection,
		'lastEdit'		=> Carbon\Carbon::now(),
		'editType'		=> "UPDATED: $oldSection to $taskSection",
	]);}


// ****************************
// DEVTIP matched - update only
// ****************************
if($taskSection=="Tip" && $listRef=="devtip"){
	//update query
	devtip::where('taskID','=',$taskID)
	->update([
		'taskSection'	=> $taskSection,
		'lastEdit'		=> Carbon\Carbon::now(),
		'editType'		=> "UPDATED: $oldSection to $taskSection",
	]);}

// *******************************
// DEVEXCUSE matched - update only
// *******************************
if($taskSection=="Excuse" && $listRef=="devexcuse"){
	//update query
	devexcuse::where('taskID','=',$taskID)
	->update([
		'taskSection'	=> $taskSection,
		'lastEdit'		=> Carbon\Carbon::now(),
		'editType'		=> "UPDATED: $oldSection to $taskSection",
	]);}


// ******************
// output json & exit
// ******************
$idArray = array(
	'status'		=> 'success',
	'reload'		=> $reload,
	'redirect'		=> $redirect,
	'taskoption'	=> 'tasksection',
	'listRef'		=> $listRef,
	'tasksection'	=> $taskSection,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();