<?php

$synchLoop=true;
$compareLoop=true;

// gets retsID
include('retsList.php');

// while loop 
// set $synch=false to stop
while($synchLoop){
	// gets logID
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_checkLog.php");
	//set variables by nextSynch
	include(app_path()."/rets/$retsSystem/$mlsName/synch/variables/nextSynch.php");
	// rets credentials & table names
	include(app_path()."/rets/$retsSystem/$mlsName/synch/variables/mainVariables.php");
	//reset if records
	if($mainCount>0){
		//resets Tables
		include(app_path()."/rets/$retsSystem/$mlsName/synch/functions/mainTable_reset.php");}
	//check metadata
	include(app_path()."/rets/$retsSystem/$mlsName/synch/functions/metaTable_check.php");
	//mart starting time
	include(app_path()."/rets/$retsSystem/$mlsName/synch/log/synch_startLog.php");
	//loops thru current search & inserts
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_loop.php");
	//copies to synchTable as final backup
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_finalBackup.php");
	//count records in table & compare
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_verify.php");
	// logs end time, sets next synch 
	// & send JSON reply
	include(app_path()."/rets/$retsSystem/$mlsName/synch/log/synch_endLog.php");

}

while($compareLoop){
	include(app_path()."/rets/$retsSystem/$mlsName/compare/compare_index.php");
}



