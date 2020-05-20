<?php

Use App\devJournal\models\devtask;

devtask::where('taskID','=',$taskID)
->update([
	'lastEdit'=>\Carbon\Carbon::now(),
	'editType'=>'taskBump',
]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskBump',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();