<?php

Use App\devJournal\models\devtask;

devtask::where('taskID','=',$taskID)
->update([
	'taskFlag'=>1,
	'taskFlagDate'=>\Carbon\Carbon::now(),
	'lastEdit'=>\Carbon\Carbon::now(),
	'editType'=>'taskFlag',
]);

//output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'taskFlag',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();