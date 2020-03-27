<?php

// get logID
include('synch_checkLog.php');

// set variables by nextSynch
include('variables/nextSynch.php');

// rets credentials & table names
include("variables/mainVariables.php");

// reset if records
if($mainCount>0){
	// resets Tables
	include('functions/mainTable_reset.php');
	// check metadata
	include("functions/metaTable_check.php");

}elseif ($backupCount>0){
	// if main has no records but backup does
	// fill main table with backup records to start
	// if not added it will make backup zero
	DB::connection('rets')
	->select( DB::raw("
	    INSERT INTO $mainTable
	    SELECT * FROM $backupTable"));

	// resets Tables
	include('functions/mainTable_reset.php');
	// check metadata
	include("functions/metaTable_check.php");
	
}else{
	//echo "error with table counts";
	//exit();
}

//mark starting time
include("log/synch_startLog.php");

//loops thru current search & inserts
include("synch_loop.php");

//copies to synchTable as final backup
include("synch_finalBackup.php");

//count records in table & compare
include("synch_verify.php");

// logs end time, sets next synch 
// & send JSON reply
include("log/synch_endLog.php");