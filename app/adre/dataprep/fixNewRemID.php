<?php

//models
use App\models\core\agtoffice;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\oldsite\oldAgent;

// default change later
// if newRemID created in loop
$setNew=0;
// main query for null newRemID
$nullRemID=agtOffice::select('propagent_id')
whereNull('newRemID')
->get();
// run loop
foreach($nullRemID as $the){
	//determine current record
	$thisID=$nullRemID['propagent_id'];
	//check for existence
	$theAgentMeta=propagentmeta::select('newRemID')
	->where('propagent_id','=',$thisID)
	->first();
	//set newRemID
	$newRemID=$theAgentMeta['newRemID'];
	// can remove this later
	// its only a test for conflicts
	// between agentMeta & agentCleanup
	if(!$newRemID){
		// check cleanup
		// only a test
		$theAgentCleanup=propagentcleanup::select('newRemID')
		->where('propagent_id','=',$thisID)
		->first();
		// set it
		$newRemID=$theAgentCleanup['newRemID'];
		// if one is found its strange
		// error out
		if($newRemID){
			dd('Strange Finding this '.$newRemID);}}

	//ok to set newRemID if not found
	if(!$newRemID){
		//flag new
		$setNew=1;
		//generates *new* newRemID variable
		include(app_path().'/functions/keyGens/newRemID.php');}

	// update
	// agtoffice
	agtoffice::where('propagent_id','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);
	// propagentmeta
	propagentmeta::where('propagent_id','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);
	// propagentcleanup
	propagentcleanup::where('propagent_id','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);
	// remote site - emailagents
	oldAgent::where('umid','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);

	dd('check first run');

}