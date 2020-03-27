<?php 

//model
Use App\devJournal\models\devtask;

//create new
$newAdd=devtask::create([
	'authLevel'		=> $authLevel,
	'taskFlag'		=> 1,
	'taskFlagDate'	=> \Carbon\Carbon::now(),
	'taskDesc'		=> $taskDesc,
	'adminID'		=> $adminID,
	'lastEdit'		=> \Carbon\Carbon::now(),
	'commentSort'	=> 'asc',
]);

// get NEW taskID
$taskID=$newAdd['taskID'];

// NEW devtask vars
$listRef='devtask';
// create moveThis variables
include(app_path().'/devJournal/variables/taskMoveVars.php');

//if FIX: update as Bug
if(strpos($taskDesc,'FIX:')!==false){
	devtask::where('taskID','=',$taskID)
	->update([
		'taskType' => 'Bug',]);}

//set oldModel
$oldModel='App\devJournal\models\devtask';	
$oldSection='devtask';
$desc='taskDesc';
$theDesc=$taskMove['taskDesc'];
$redirect=null;
$taskTrim=substr($taskDesc, 0, 4);

// set new Model & MOVE if needed
// *TIP*
if(strpos($taskTrim,'TIP:')!==false){
	//set to devtip model
	$desc='tipDesc';
	$taskSection='Tip';
	$taskType='Tip';	
	$redirect='Tip';
	$newModel='App\devJournal\models\devtip';
	//taskMove Code
	include('taskMove.php');
// *EXCUSE*
}elseif(strpos($taskTrim,'?!:')!==false){
	//set to devexcuse model
	$desc='excuseDesc';	
	$taskSection='Excuse';
	$taskType='Excuse';
	$redirect='Excuse';
	$newModel='App\devJournal\models\devexcuse';
	//remove prefix from description
	$theDesc=str_replace("?!:","",$theDesc);
	//taskMove Code
	include('taskMove.php');}

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'redirect'		=> $redirect,
	'taskoption'	=> 'taskAdd',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();