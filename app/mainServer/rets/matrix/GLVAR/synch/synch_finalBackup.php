<?php

$tableDrop=$synchTable;
$thisProcess="Dropping $synchTable...";
//log the tableDrop for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableDrop.php");

//Step 1.
//drop existing table
\Schema::connection('rets')
->dropIfExists($synchTable);

//Step 2.
//recreate synch table
\DB::connection('rets')
->statement("
	CREATE TABLE $synchTable
	LIKE $mainTable");

$insertNow=$synchTable;
$thisModel=$synchModel;
$thisTotal=$mainModel::count();
$thisProcess="Copying records from $mainTable into $synchTable ...";
//log the tableCreate for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");

// Step 3.
// to get counts during process
// set transaction level
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");
// insert current into synch
$results = DB::connection('rets')
->select( DB::raw("
    INSERT INTO $synchTable
    SELECT * FROM $mainTable
"));
// reset
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;");

$insertNow=NULL;
$thisModel=NULL;
$thisTotal=NULL;
$thisProcess="$synchTable Complete!";
//log the tableCreate for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");
