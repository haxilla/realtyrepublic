<?php

// default vars
$oldModel=null;
$newModel=null;
$redirect=null;
$reload=null;
$taskModel=null;
$markedBy=$adminID;

// ****************************************
// going IN OR OUT of devtip or devexuse
// when listRef & taskSection are not equal
// ****************************************
if(($taskSection=='Tip' && $listRef != "devtip")||
($taskSection=='Excuse' && $listRef != "devexcuse")||
($listRef=='devtip' && $taskSection != "Tip")||
($listRef=='devexcuse' && $taskSection != "Excuse")){

	// sets variables for moving
	include(app_path().'/devJournal/variables/taskMoveVars.php');
	// moves task from listRef to taskSection
	include('taskMove.php');}

// **********************************
// when tip or excuse is not involved 
// just update devtask
// **********************************

//reset thisModel
$thisModel=null;
//if not tip or excuse its a devtask
if(($taskSection!="Tip" && $taskSection!="Excuse"
&& $listRef!="devtip" && $listRef!="devexcuse")){
	$thisModel='App\devJournal\models\devtask';}
// ****************************
// DEVTIP matched - update only
// ****************************
if($taskSection=="Tip" && $listRef=="devtip"){
	$thisModel='App\devJournal\models\devexcuse';;}
// *******************************
// DEVEXCUSE matched - update only
// *******************************
if($taskSection=="Excuse" && $listRef=="devexcuse"){
	$thisModel='App\devJournal\models\devexcuse';}

//if thisModel set above do update
if($thisModel){
	//check if exists
	$existing=$thisModel::where('taskID','=',$taskID)
	->first();
	//error if none
	if(!$existing){
		dd('error-line53-taskSection.php');}

	$oldSection=$existing['taskSection'];
	if(!$oldSection){
		$oldSection='none';}

	//update
	$thisModel::where('taskID','=',$taskID)
	->update([
		'taskSection'	=> $taskSection,
		'lastEdit'		=> Carbon\Carbon::now(),
		'editType'		=> "UPDATED: $oldSection to $taskSection",
		'editBy'		=> $adminID,
	]);}


// ******************
// output json & exit
// ******************
$idArray = array(
	'status'		=> 'success',
	'reload'		=> $reload,
	'redirect'		=> $redirect,
	'taskoption'	=> 'tasksection',
	'thisModel'		=> $thisModel,
	'taskModel'		=> $taskModel,
	'oldModel'		=> $oldModel,
	'newModel'		=> $newModel,
	'listRef'		=> $listRef,
	'tasksection'	=> $taskSection,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();