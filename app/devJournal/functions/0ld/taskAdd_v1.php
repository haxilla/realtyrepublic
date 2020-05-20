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

//get taskID
$taskID=$newAdd['taskID'];

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskAdd',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();