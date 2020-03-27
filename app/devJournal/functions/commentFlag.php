<?php

//model
Use App\devJournal\models\devtaskcomment;

//get commentID
$commentID=request('commentID');
$flag=request('flag');

//error if none
if(!$commentID){
	dd('error-line8-flagComment.php');}

devtaskcomment::where('commentID','=',$commentID)
->update([
	'commentFlag'	=> $flag,
	'flagDate'		=> \Carbon\Carbon::now(),
	'flaggedBy'		=> $adminID
]);

//output json & exit
$idArray = array(
	'status'=>'Success',
);

echo json_encode($idArray);
exit();