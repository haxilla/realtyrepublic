<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtaskdetail;

//set nulls
$newLink=null;
$newLinkID=null;
$newLinkURL=null;
$newLinkTitle=null;
$newLinkType=null;
$updateID=null;
//set requests
$taskID=request('taskID');
$linkID=request('linkID');
$linkType=request('linkType');
$linkTitle=request('linkTitle');
$linkURL=request('linkURL');
$softDelete=request('softDelete');

//null new 
if($linkID=='new'){
	$linkID=null;}

//if softDelete - mark & exit
if($softDelete  && $linkID){
	devtaskdetail::where('linkID','=',$linkID)
	->update([
		'softDelete'	=> \Carbon\Carbon::now(),
		'softDeleteBy'	=> $adminID,]);

	//output json & exit
	$idArray = array(
		'status'		=> 'Success',
		'softDelete'	=> $linkID,);

	echo json_encode($idArray);
	exit();}

//must have linkTitle & linkURL
if(!$linkTitle || !$linkURL){
	//output json & exit
	$idArray = array(
		'status'		=> 'Unchanged',
		'taskID'		=> $taskID,
		'linkID'		=> $linkID,
		'linkTitle'		=> $linkTitle,
		'linkURL'		=> $linkURL);

	echo json_encode($idArray);
	exit();}

//must have either taskID or linkID
if(!$taskID && !$linkID){
	//output json & exit
	$idArray = array(
		'status'		=> 'Unchanged',
		'taskID'		=> $taskID,
		'linkID'		=> $linkID,);

	echo json_encode($idArray);
	exit();}

//update linkID
if($linkTitle && $linkURL && $linkID && !$taskID){

	//validate
	$validator = Validator::make($request::all(), [
	'linkTitle' => 'required',
	'linkURL'	=> 'required|active_url|bail']);

	//if fails return back
	if ($validator->fails()){
		//output json & exit
		$idArray = array(
			'status' => 'validation failure',);

		echo json_encode($idArray);
		exit();}

	devtaskdetail::where('linkID','=',$linkID)
	->update([
		'linkType' 	=> $linkType,
		'linkTitle'	=> $linkTitle,
		'linkURL'	=> $linkURL,
		'linkEdit'	=> \Carbon\Carbon::now(),
	]);}

//new link added for task
if($linkTitle && $linkURL && $taskID){
	//query for existing linkID
	$getLinkID=devtaskdetail::select('linkID')
	->orderBy('linkID','desc')
	->first();
	$linkID=$getLinkID['linkID'];
	//set value of linkID
	if(!$linkID){
		$linkID=1;
	}else{
		$linkID=$getLinkID['linkID']+1;}

	//validate
	$validator = Validator::make($request::all(), [
		'linkTitle' => 'required',
		'linkURL'	=> 'required|active_url|bail',
	]);

	//if fails return back
	if ($validator->fails()){
		//output json & exit
		$idArray = array(
			'status' => 'validation failure',
		);

		echo json_encode($idArray);
		exit();}

	//create new link in devtaskdetail
	devtaskdetail::create([
		'taskID'		=> $taskID,
		'linkID'		=> $linkID,		
		'linkType'		=> $linkType,
		'linkTitle'		=> $linkTitle,
		'linkURL'		=> $linkURL,
	]);

	//update dates in devtask
	devtask::where('taskID','=',"$taskID")
	->update([
		'lastComment'	=>\Carbon\Carbon::now(),
		'lastEdit'		=>\Carbon\Carbon::now(),
		'editType'		=>'added new link URL',
	]);

	//get new commentID
	$newLinkID=$linkID;
	$newLink=1;}

//output json & exit
$idArray = array(
	'newLink'		=> $newLink,
	'linkTitle'		=> $linkTitle,
	'linkType'		=> $linkType,
	'linkURL'		=> $linkURL,
	'linkID'		=> $newLinkID,
	'taskID'		=> $taskID,
);

echo json_encode($idArray);
exit();

