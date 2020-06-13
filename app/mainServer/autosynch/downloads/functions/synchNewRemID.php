<?php

//models
use App\autosynch\models\agtoffice\agtoffices;
use App\autosynch\models\propagentmeta\propagentmetas;
use App\autosynch\models\propagent\propagentOld;
use App\models\core\propagentcleanup;
use App\models\core\propagentmeta;


// default change later
// if newRemID created in loop
$setNew=0;
$foundIn='none';
// main query for null newRemID
$nullRemID=agtOffices::select('propagent_id')
->whereNull('newRemID')
->get();
// run loop
foreach($nullRemID as $the){
	//determine current record
	$thisID=$the->propagent_id;
	//check for existence
	$theAgentCleanup=propagentcleanup::select('newRemID')
	->where('propagent_id','=',$thisID)
	->first();
	//set newRemID
	$newRemID=$theAgentCleanup['newRemID'];
	//set where found
	if($newRemID){
		$foundIn='theAgentCleanup';}

	//if not found check more
	if(!$newRemID){
		// check meta
		$theAgentMeta=propagentmeta::select('newRemID')
		->where('propagent_id','=',$thisID)
		->first();
		// set it
		$newRemID=$theAgentMeta['newRemID'];
		$foundIn='theAgentMeta';
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
	propagentOld::where('umid','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);
	// agtoffice
	agtoffices::where('propagent_id','=',$thisID)
	->update([
		'newRemID'=>$newRemID,
	]);
}