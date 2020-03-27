<?php

//check url variables
include('variables/synchID.php');

$synchComplete=$synchLog['synchComplete'];
//monitor tableDrop
$tableDrop=$synchLog['tableDrop'];
$tableDropName=$synchLog['tableDropName'];
//monitor tableArchive
$tableArchive=$synchLog['tableArchive'];
$tableArchiveName=$synchLog['tableArchiveName'];
//progress message
$progressMessage=$synchLog['progressMessage'];

//source name
$oldNameCount=$currentSynch.'Old';
//source count
$expectedCount=$synchLog["$oldNameCount"];

//add archiveCount to expectedCount
if($synchArchiveName){
	$archiveModel="App\autosynch\models\\remarchives\\$synchArchiveName";
	$archiveCount=$archiveModel::count();
	$expectedCount=$expectedCount+$archiveCount;}

//tableDropName
//set currentCount
if($tableDropName){
	$tableDropped="App\autosynch\models\\$currentSynch\\$tableDropName";
	$currentCount=$tableDropped::count();
}else{
	$currentCount=0;}

//if Archive Ready
if($tableArchiveName){
	$tableMains=$currentSynch.'s';
	$currentModel="App\autosynch\models\\$currentSynch\\$tableMains";
	$currentCount=$currentModel::count();}

// its a download or resize
if($tableSchema=='download'){
	$currentModel="App\autosynch\models\downloads\\$currentSynch";
	$modelCount=$currentModel::downloadCount();
	//must subtract to make currentCount math work
	$currentCount=$expectedCount-$modelCount;}

//default percentage
$percentComplete=0;
//avoid division by zero error
if($expectedCount>0){
	//set percentComplete
	$percentComplete=$currentCount/$expectedCount*100;
	//round to nearest whole
	$percentComplete=round($percentComplete,0);}

// do not show 100% as first check
// start counting after tableDrop
if(!$tableDrop && $percentComplete=='100'
&& $tableSchema != "download"){
	$percentComplete=0;}

//output json & exit
$idArray = array(
	'synchID'			=> $synchID,
	'synchComplete'		=> $synchComplete,
	'currentSynch'		=> $currentSynch,
	'currentCount'		=> $currentCount,
	'expectedCount'		=> $expectedCount,
	'percentComplete'	=> $percentComplete,
	'tableDrop'			=> $tableDrop,
	'tableDropName'		=> $tableDropName,
	'tableArchiveName'	=> $tableArchiveName,
	'progressMessage'	=> $progressMessage,
);

echo json_encode($idArray);
exit();