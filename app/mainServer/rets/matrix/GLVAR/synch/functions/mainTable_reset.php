<?php

//Step 1.
$tableDrop		= $backupTable;
$thisProcess	= 'Resetting '.$mainTable;

//log the tableDrop for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableDrop.php");

if(Schema::connection('rets')
->hasTable($mainTable)){
	// Step 1.
	// drop backup table
	\Schema::connection('rets')
	->dropIfExists($backupTable);
	// Step 2.
	// recreate arch table
	\DB::connection('rets')
	->statement("
		CREATE TABLE $backupTable
		LIKE $mainTable");
}else{
	dd('error-line22-mainTable_reset.php');}

$insertNow=$backupTable;
$thisModel=$backupModel;
$thisTotal=$mainModel::count();
$thisProcess="Inserting $mainTable into $backupTable...";
//log the tableCreate for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");

//Step 3.
// to get counts during process
// set transaction level
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;");

// insert current into arch
$results = DB::connection('rets')
->select( DB::raw("
    INSERT INTO $backupTable
    SELECT * FROM $mainTable
"));

// reset isolation level when done
DB::statement("
  SET GLOBAL TRANSACTION ISOLATION LEVEL REPEATABLE READ;");

//set table
$tableDrop=$mainTable;
$thisProcess="Dropping $mainTable...";
//log the tableDrop for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableDrop.php");
//Step 4.
//drop rets_property_listing
\Schema::connection('rets')
->dropIfExists($mainTable);

//Step 5.
//create current table like arch
//recreate arch table
\DB::connection('rets')
->statement("
	CREATE TABLE $mainTable
	LIKE $backupTable");

$insertNow=NULL;
$thisModel=NULL;
$thisTotal=NULL;
$thisProcess="$mainTable Recreated";
//log the tableCreate for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");