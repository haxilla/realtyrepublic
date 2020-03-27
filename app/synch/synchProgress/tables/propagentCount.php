<?php

//models
use App\models\core\propagent;
use App\models\oldsite\oldAgent;
use App\models\synch\synchLog;

//query
$getSynchID=synchLog::select('synchID','tableDrop')
->where('synchID','=',$synchID)
->first();

//set variables
$synchID=$getSynchID['synchID'];
$tableDrop=$getSynchID['tableDrop'];

//get counts
if(!Schema::hasTable('propagents')){
	$currentCount=0;
}else{
	$currentCount=propagent::count();}

$expectedCount=oldAgent::count();
$percentComplete=$currentCount/$expectedCount*100;

if(!$tableDrop && $percentComplete=='100'){
	$percentComplete=0;
}

//output json & exit
$idArray = array(
	'thisClass'			=> 'propagent',
	'nextClass'			=> 'agtoffice',
	'currentCount'		=> $currentCount,
	'expectedCount'		=> $expectedCount,
	'percentComplete'	=> $percentComplete,
);

echo json_encode($idArray);
exit();


