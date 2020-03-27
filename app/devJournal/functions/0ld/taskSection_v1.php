<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;

//tasksection is where they want it
//listref is where it currently is
if($listRef=='devtask'){
	$moveThis=devtask::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['taskDesc'];
}else if($listRef=='devexcuse'){
	$moveThis=devexcuse::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['excuseDesc'];
}else if($listRef=='devtip'){
	$moveThis=devtip::where('taskID','=',$taskID)
	->first();
	$theDesc=$moveThis['tipDesc'];
}else{
	//error if here
	dd('error-line27-tasksection.php');}
	
// main variables
$created_at=$moveThis['created_at'];
$updated_at=$moveThis['updated_at'];
$lastComment=$moveThis['lastComment'];
$versionID=$moveThis['versionID'];
$taskComplete=$moveThis['taskComplete'];
$authLevel=$moveThis['authLevel'];
$thisAdminID=$moveThis['adminID'];
$markedBy=$adminID;

// old model based on listRef
$oldModel="\App\devJournal\models\\".$listRef;
$desc='taskDesc';

//goint INTO tip or excuse
if(($taskSection=='Tip' && $listRef != "devtip")||
($taskSection=='Excuse' && $listRef != "devexcuse")){
	//set model
	if($taskSection=="Tip"){
		$taskModel="devtip";
		$desc='tipDesc';
	}elseif($taskSection=="Excuse"){
		$taskModel="devexcuse";
		$desc='excuseDesc';
	}else{
		dd('error-line50-taskSection.php');}

	$newModel="\App\devJournal\models\\".$taskModel;
	//create new
	$newModel::create([
		'created_at'	=> $created_at,
		'updated_at'	=> $updated_at,
		"$desc"			=> $theDesc,
		'taskID'		=> $taskID,
		'lastComment'	=> $lastComment,
		'versionID'		=> $versionID,
		'taskComplete'	=> $taskComplete,
		'authLevel'		=> $authLevel,
		'adminID'		=> $thisAdminID,
		'markedBy'		=> $markedBy,
	]);
	//delete old
	$oldModel::where('taskID','=',$taskID)
	->delete();}

//coming FROM tip or excuse into devtask
if($taskSection!="Tip" && $taskSection!="Excuse"
&& ($listRef=="devtip"||$listRef=="devexcuse")){

}

//output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'tasksection',
	'listRef'		=> $listRef,
	'tasksection'	=> $taskSection,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();