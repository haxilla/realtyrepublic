<?php

//model
Use App\models\synch\synchLog;
Use App\models\synch\synchVar;

//url vars
$synchID=request('synchID');
$currentSynch=request('currentSynch');
$synchType=request('synchType');

//if no synchID find it
if(!$synchID){

	//use currentSynch & synchType to find 
	if($currentSynch && $synchType){
		//base query
		$synchLog=synchLog::where('synchType','=',$synchType)
		->whereNotNull('synchStart')
		->whereNull('synchComplete');
		
		//synchOne or synchAll
		if($synchType=='synchOne'){
			$synchLog=$synchLog
			->where('currentSynch','=',$currentSynch)
			->first();
		}elseif($synchType=='synchAll'){
			$synchLog=$synchLog
			->first();
		}else{
			dd('error-line28-synchID.php');}

		//set synchID
		//make sure key exists
		if(isset($synchLog['synchID'])){
			$synchID=$synchLog['synchID'];
		}else{
			$synchID=null;};
		
		//exit if not found yet
		if(!$synchID){
			//output json & exit
			$idArray = array(
				'synchComplete'		=> null,
				'synchID'			=> null,
			);
			echo json_encode($idArray);
			exit();}

	//error if none
	}else{
		dd('error-line18-synchProgress.php');}
}

//query for synch info
$synchLog=synchLog::where('synchID','=',$synchID)
->first();

//error if none
if(!$synchLog){
	dd('error-line19-autosynch/synchProgress.php');}

//query for synch info
$synchLog=synchLog::where('synchID','=',$synchID)
->first();
//error if none
if(!$synchLog){
	dd('error-line19-autosynch/synchProgress.php');}

//get name of synch
$currentSynch=$synchLog['currentSynch'];
$synchType=$synchLog['synchType'];

// ********************** //
// synchVar
// query table variables
// ********************** //
$synchVar=synchVar::where('tableMain','=',$currentSynch)
->select('tableArchive','tableSchema')
->first();

//set archiveName
$synchArchiveName=$synchVar['tableArchive'];
$tableSchema=$synchVar['tableSchema'];
