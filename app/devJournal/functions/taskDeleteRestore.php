<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskcomment;

//tasks
devtask::where('taskID','=',$taskID)
->update([
	'softDelete'	=> null,
	'softDeleteBy'	=> null,]);

//associated comments
devtaskcomment::where('taskID','=',$taskID)
->update([
	'softDelete'	=> null,
	'softDeleteBy'	=> null,]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskDeleteRestore',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();