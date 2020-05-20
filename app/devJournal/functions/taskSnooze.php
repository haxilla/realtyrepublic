<?php

Use App\devJournal\models\devtask;

$snoozeTimer=request('snoozeTimer');
$indefinite=null;

if(!$snoozeTimer){
	dd('error-line8-taskSnooze.php');}

if($snoozeTimer=='fewHours'){
	$snoozeDate=\Carbon\Carbon::now()->addHours('3');
}elseif($snoozeTimer=='oneDay'){
	$snoozeDate=\Carbon\Carbon::now()->addDays('1');
}elseif($snoozeTimer=='fewDays'){
	$snoozeDate=\Carbon\Carbon::now()->addDays('3');
}elseif($snoozeTimer=='week'){
	$snoozeDate=\Carbon\Carbon::now()->addWeeks('1');
}elseif($snoozeTimer=='month'){
	$snoozeDate=\Carbon\Carbon::now()->addMonths('1');
}elseif($snoozeTimer=='indefinite'){
	$snoozeDate=\Carbon\Carbon::now();
	$indefinite=1;
}else{
	dd('error-line21-taskSnooze.php');}

devtask::where('taskID','=',$taskID)
->update([
	'snoozeDate'=>$snoozeDate,
	'indefinite'=>$indefinite,
	'snoozeBy'	=>$adminID,
]);

//output json & exit
$idArray = array(
	'status'			=> 'reload',
	'taskoption'		=> 'tasksnooze',
	'taskSnoozeDate'	=> $snoozeDate,
	'taskID'			=> $taskID,);

echo json_encode($idArray);
exit();