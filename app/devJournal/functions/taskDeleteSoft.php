<?php

//models
Use App\devJournal\models\devtask;
Use App\devJournal\models\devtip;
Use App\devJournal\models\devexcuse;
Use App\devJournal\models\devtaskcomment;

// update all possibilities
// *devtask* //
devtask::where('taskID','=',$taskID)
->update([
	'softDelete'	=> \Carbon\Carbon::now(),
	'softDeleteBy'	=> $adminID,]);
// *devtip* //
devtip::where('taskID','=',$taskID)
->update([
	'softDelete'	=> \Carbon\Carbon::now(),
	'softDeleteBy'	=> $adminID,]);
// *devexcuse* //
devexcuse::where('taskID','=',$taskID)
->update([
	'softDelete'	=> \Carbon\Carbon::now(),
	'softDeleteBy'	=> $adminID,]);

//associated comments
devtaskcomment::where('taskID','=',$taskID)
->update([
	'softDelete'	=> Carbon\Carbon::now(),
	'softDeleteBy'	=> $adminID,]);

//output json & exit
$idArray = array(
	'status'		=> 'reload',
	'taskoption'	=> 'taskDeleteSoft',
	'taskID'		=> $taskID,);

echo json_encode($idArray);
exit();