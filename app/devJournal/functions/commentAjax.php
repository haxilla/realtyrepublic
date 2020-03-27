<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskcomment;
Use App\devJournal\models\masterVersion;

//set variables
$newCommentID=null;
$taskID=request('taskID');
$commentID=request('commentID');
$taskComment=request('taskComment');
$softDelete=request('softDelete');
$newComment=null;

//must have taskID or commentID
if(!$taskID && !$commentID){
	dd('error-line7-addTaskComment');}

//if softDelete - mark & exit
if($softDelete){
	devtaskcomment::where('commentID','=',$commentID)
	->update([
		'softDelete'	=>\Carbon\Carbon::now(),
		'softDeleteBy'	=>$adminID,]);

	//output json & exit
	$idArray = array(
		'status'		=> 'Success',
		'softDelete'	=> $commentID,);

	echo json_encode($idArray);
	exit();}

//get versionID
$versionID=masterVersion::orderBy('id','desc')
->pluck('versionID')
->first();

//new comment for task
if($taskComment && $taskID){
	//create new taskComment
	$newComment=devtaskcomment::create([
		'taskComment'	=> $taskComment,
		'taskID'		=> $taskID,
		'adminID'		=> $adminID,
		'commentFlag'	=> 1,
		'versionID'		=> $versionID,
	]);

	//update lastComment date
	devtask::where('taskID','=',"$taskID")
	->update([
		'lastComment'	=>\Carbon\Carbon::now(),
		'lastEdit'		=>\Carbon\Carbon::now(),
		'editType'		=>'commentAdd',
	]);

	//get new commentID
	$newCommentID=$newComment['commentID'];
	$newComment=1;
}

//update commentID
if($taskComment && $commentID){

	devtaskcomment::where('commentID','=',$commentID)
	->update([
		'taskComment' 	=> $taskComment,
		'lastEdit'		=> \Carbon\Carbon::now(),
	]);

	$newCommentID=$commentID;
}

//output json & exit
$idArray = array(
	'taskComment'	=> $taskComment,
	'commentID'		=> $newCommentID,
	'taskID'		=> $taskID,
	'newComment'	=> $newComment,
);

echo json_encode($idArray);
exit();

