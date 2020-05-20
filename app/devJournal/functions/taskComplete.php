<?php

Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskcomment;
Use App\devJournal\models\masterVersion;

//get currentVersion
$currentVersion=masterVersion::orderBy('id','desc')
->first();

//get versionID
$versionID=$currentVersion['versionID'];

//set versionCount
$versionCount=$currentVersion['versionCount'];
$newCount=$versionCount+1;

//set versionTag
$versionTag=$versionID.$versionCount.$taskID;

//update the version count
masterVersion::where('versionID','=',"$versionID")
->update([
	'versionCount'=>$newCount,
	'microVersion'=>$versionTag,
	'lastGitPush'=>null,
	'lastGitPull'=>null,]);

//mark taskComplete & version
devtask::where('taskID','=',"$taskID")
->update([
	'taskComplete'=>\Carbon\Carbon::now(),
	'completedBy'=>$adminID,
	'versionTag'=>$versionTag,
	'indefinite'=>null,
	'snoozeDate'=>null,
	'taskFlag'=>0,
	'taskPriority'=>0,]);

//clear commentFlags
devtaskcomment::where('taskID','=',$taskID)
->update([
	'commentFlag'=>0,
	'flagDate'=>null,]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskComplete',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();