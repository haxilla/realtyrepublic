<?php

Use App\devJournal\models\devtask;

devtask::where('taskID','=',$taskID)
->update([
	'taskFlag'=>0,
	'taskFlagDate'=>null,
	'lastEdit'=>\Carbon\Carbon::now(),
	'editType'=>'taskUnflag',
]);

//output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'taskUnflag',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();