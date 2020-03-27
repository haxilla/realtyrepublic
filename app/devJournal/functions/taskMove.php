<?php

//old model based on listRef
$oldModel="\App\devJournal\models\\".$listRef;
$newModel="\App\devJournal\models\\".$taskModel;

//create new
$newModel::create([
	'created_at'	=> $created_at,
	'updated_at'	=> $updated_at,
	'stickyDate'	=> $stickyDate,
	"$desc"			=> $theDesc,
	'taskID'		=> $taskID,
	'taskSection'	=> $taskSection,
	'taskType'		=> $taskType,
	'lastEdit'		=> \Carbon\Carbon::now(),
	'editType'		=> "MOVED: $oldSection to $taskSection",
	'lastComment'	=> $lastComment,
	'versionID'		=> $versionID,
	'taskComplete'	=> $taskComplete,
	'authLevel'		=> $authLevel,
	'adminID'		=> $oldAdminID,
	'markedBy'		=> $adminID,]);

//delete old
$oldModel::where('taskID','=',$taskID)
->delete();