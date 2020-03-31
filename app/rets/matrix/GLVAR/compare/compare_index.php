<?php

//error reporting
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set("display_errors", 1);

//checks logs for retsLoop
include("compare_checklog.php");

$startLogName=$retsClass.'_compareStart';
$endLogName=$retsClass.'_compareEnd';

if($retsLoop==$startLogName){
	$startLogPath="compareLog_startClass.php";
	include($startLogPath);

}elseif($retsLoop==$endLogName){
	$endLogPath="compareLog_endClass.php";
	include($endLogPath);

}else{

	// table names

	// ex. $nowHomes=GLVAR_Homes
	${'now'.$retsClass} = $mlsName.'_'.$retsClass;
	// ex. $oldHomes=GLVAR_Homes_backup
	${'old'.$retsClass} = $mlsName.'_'.$retsClass."_backup";
	//set files
	$theQueryFile = "$retsClass/mysql/$retsLoop".'Query.php';
	//Query
	include($theQueryFile);
	//Loop
	include("compare_loop.php");
	//Updates & sends JSON
	include("compare_JSON.php");

}


/* ALTER TABLES WHEN COMPLETE */

/*
/* Homes */
/*
MatrixModifiedDT
PhotoModificationTimestamp
PriceChangeTimestamp
PriceChgDate
OriginalEntryTimestamp
NODDate
----------------------
GLVAR_Homes,
GLVAR_Homes_backup,
GLVAR_Homes_synch,


*/
/* Agents */
/*
PhotoModificationTimestamp
ProviderModificationTimestamp
MatrixModifiedDT
-----------------------
GLVAR_Agents,
GLVAR_Agents_backup,
GLVAR_Agents_synch

*/
/* Offices */
/*
MembershipDate
MatrixModifiedDT
TerminationDate
-------------------------
GLVAR_Offices,
GLVAR_Offices_backup,
GLVAR_Offices_synch
*/
/*

//Column Type
//
USE rets

ALTER TABLE GLVAR_Agents
MODIFY PhotoModificationTimestamp timestamp

//Value
//
UPDATE GLVAR_Agents
SET PhotoModificationTimestamp=NULL
WHERE PhotoModificationTimestamp
LIKE '%%0000-00%';

*/
