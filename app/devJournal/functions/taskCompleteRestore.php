<?php

Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskcomment;

//mark taskComplete & version
devtask::where('taskID','=',"$taskID")
->update([
	'taskComplete'	=> null,
	'completedBy'	=> null,
	'versionTag'	=> null,
	'taskFlag'		=> 1,
	'taskFlagDate'	=> \Carbon\Carbon::now(),
	'taskPriority'	=> 0,]);

//clear commentFlags
devtaskcomment::where('taskID','=',$taskID)
->update([
	'commentFlag'=>1,
	'flagDate'=>\Carbon\Carbon::now(),]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskCompleteRestore',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();