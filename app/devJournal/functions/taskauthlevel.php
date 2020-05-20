<?php

Use App\devJournal\models\devtask;

devtask::where('taskID','=',$taskID)
->update([
	'authLevel'=>$taskauthlevel,
	'lastEdit'=>\Carbon\Carbon::now(),
	'editType'=>'authLevel',
]);

//output json & exit
$idArray = array(
	'status'		=> 'success',
	'taskoption'	=> 'taskauthlevel',
	'taskauthlevel'	=> $taskauthlevel,
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();