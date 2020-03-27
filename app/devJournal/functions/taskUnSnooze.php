<?php

Use App\devJournal\models\devtask;

devtask::where('taskID','=',$taskID)
->update([
	'snoozeDate'=>null,
	'indefinite'=>null,
	'lastEdit'	=> \Carbon\Carbon::now(),
	'editType'	=> 'UN-snoozed',
]);

//output json & exit
$idArray = array(
	'status'			=> 'reload',
	'taskoption'		=> 'taskUnSnooze',
	'taskID'			=> $taskID,);

echo json_encode($idArray);
exit();