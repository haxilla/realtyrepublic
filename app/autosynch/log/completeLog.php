<?php

//model
Use App\models\synch\synchLog;

//default column name
$column=$currentSynch.'Synch';
if($currentSynch=='complete'){
	$column='synchComplete';
	$status='complete';}

//update query
synchLog::where('synchID','=',$synchID)
->update([
	"$column"					=> \Carbon\Carbon::now(),
	'lastSynch'				=> $currentSynch,
	'progressMessage'	=> "$currentSynch Complete"
]);

//if partialSynch update
if($synchType=='synchOne'
&& $partialSynch){

	//partial next or error
	if(!$partialNext){
		dd('error-line19-autosynch/log/completeLog.php');}

	//update
	synchLog::where('synchID','=',$synchID)
	->update([
		'currentSynch'=>$partialNext,
	]);}

//last item of partial synch
if(($synchType=='synchOne' && $partialComplete)
||($synchType=='synchOne' && !$partialSynch)){

	//set complete vars
	$partialSynch=0;
	$partialNext=null;
	$status='complete';

	//update query
	synchLog::where('synchID','=',$synchID)
	->update([
		"synchComplete"		=> \Carbon\Carbon::now(),
		'lastSynch'				=> $currentSynch,
		'progressMessage'	=> "$currentSynch Complete"
	]);}

//set lastSynch
$lastSynch=$currentSynch;

//if partialNext update
if($synchType=='synchOne'
&& $partialNext){
	$currentSynch=$partialNext;}

$tableComplete=null;

if($currentSynch!="complete"
&& ($synchType=='synchAll' && !$partialSynch)
||($synchType=='synchAll' && $partialComplete)){
	$tableComplete=$currentSynch;
}

//output json & exit
$idArray = array(
  'status'		 	=> $status,
  'synchID'		 	=> $synchID,
  'synchType'	 	=> $synchType,
  'currentSynch' 	=> $currentSynch,
  'tableComplete'	=> $tableComplete,
);

echo json_encode($idArray);
exit();
