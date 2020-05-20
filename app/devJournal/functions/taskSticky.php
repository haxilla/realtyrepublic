<?php

Use App\devJournal\models\devtask;

$exists=devtask::where('taskID','=',$taskID)
->select('stickyDate')
->first();
$theModel='\App\devJournal\models\devtask';
if(!$exists){
	$exists=devtip::where('taskID','=',$taskID)
	->select('stickyDate')
	->first();
	$theModel='\App\devJournal\models\devtip';
}
if(!$exists){
	$exists=devexcuse::where('taskID','=',$taskID)
	->select('stickyDate')
	->first();
	$theModel='\App\devJournal\models\devexcuse';}

if(!$exists){
	dd('error-line18-taskSticky.php');}

//see
$stickyDate=$exists['stickyDate'];

if($stickyDate){
	$stickyDate=null;
	$editType='removed stickyDate';
}else{
	$stickyDate=\Carbon\Carbon::now();
	$editType='added stickyDate';}

$theModel::where('taskID','=',$taskID)
->update([
	'stickyDate' => $stickyDate,
	'editType'	 =>	$editType,
]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskSticky',
	'editType'		=> $editType,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();
