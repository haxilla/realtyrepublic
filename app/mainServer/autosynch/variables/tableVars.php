<?php

//model
Use App\models\synch\synchVar;

//query variables
$getVars=synchVar::where('tableMain','=',$currentSynch)
->first();

//log if complete
if($currentSynch=='complete'){
	$partialSynch=null;
	$partialComplete=null;
	include(app_path().'/autosynch/log/completeLog.php');}

//error if none
if(!$getVars){
	dd('error-line9-autosynch/tableVars.php '.$currentSynch);}

//main vars
$tableMain=$currentSynch;
$tableSchema=$getVars['tableSchema'];
$tableMains=$getVars['tableMains'];
$tableBackup=$getVars['tableBackup'];
$tableSynch=$getVars['tableSynch'];
$tableFed=$getVars['tableFed'];
$tableArchive=$getVars['tableArchive'];
$tableOld=$getVars['tableOld'];

//partial synch check
$partialSynch=$getVars['partialSynch'];
$partialNext=$getVars['partialNext'];
$partialComplete=$getVars['partialComplete'];

//for single synch start
if($synchType=='synchOne'
&& $partialSynch > 0){
	$partialSynch=1;
	$partialNext=$getVars['partialNext'];}

//for single synch complete
if($synchType=='synchOne'
&& $partialComplete > 0){
	$partialComplete=1;}



