<?php

//get tableVars
include("variables/tableVars.php");
// local schema means its downloading/resizing
// defer to new file and exit
if($tableSchema=='download'){

	//include different file & exit
	include("synchDownloads.php");
	exit();}

//count before starting synch
if($currentSynch!="complete"){
	include('variables/preCounts.php');}

//checks for existence of backup tables
include("backups/backup_1prep.php");

// drops initial backup & re-inserts 
// current propagent data
include("backups/backup_2first.php");

// drops & recreates tables from source
// drop tableFed
include('drop/tableFed.php');

// create federated table
include("tables/$tableMain/federated/tableCreate.php");

//drops & recreates tables from source
//drop tableMains
include('drop/tableMains.php');

// table insert
include("tables/$tableMain/federated/tableInsert.php");

//log
include('log/dropLogEnd.php');

if($tableArchive){
	include("log/archiveLogStart.php");
	include("tables/$tableMain/archiveInsert.php");
	include("log/archiveLogEnd.php");}

// final backup
include("backups/backup_3final.php");

//end of synch log
include('log/completeLog.php');