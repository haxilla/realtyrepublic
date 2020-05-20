<?php

// models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;

// devtask
$existing=devtask::where('taskID','=',$taskID)
->first();
// vars
$descField='taskDesc';
$theDesc=$existing['taskDesc'];
$theModel="App\devJournal\models\devtask";

// * if none found query others * //
// ****************************** //

// devtip
if(!$existing){
	// query
	$existing=devtip::where('taskID','=',$taskID)
	->first();
	// vars
	$descField='tipDesc';
	$theDesc=$existing['tipDesc'];
	$theModel="App\devJournal\models\devtip";}

// devexcuse
if(!$existing){
	//query
	$existing=devexcuse::where('taskID','=',$taskID)
	->first();
	//vars
	$descField='excuseDesc';
	$theDesc=$existing['excuseDesc'];
	$theModel="App\devJournal\models\devexcuse";}

// error if none
if(!$existing){
	dd('error-line20-taskEdit.php');}

// update model
$theModel::where('taskID','=',$taskID)
->update([
	"$descField"	=> $taskDesc,
	'lastEdit'		=> \Carbon\Carbon::now(),
	'editBy'		=>	$adminID,
	'editType'		=> "Desc Edited"
]);

// output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'taskedit',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();