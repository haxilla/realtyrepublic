<?php

include('metaTable_reset.php');

//insert current into arch
$metaNew = DB::connection('rets')
->select( DB::raw("
    SELECT COUNT(*) as columnCount
	FROM INFORMATION_SCHEMA.COLUMNS
	WHERE table_schema = 'rets'
	AND table_name = '$metaTable'
"));
$metaOld = DB::connection('rets')
->select( DB::raw("
    SELECT COUNT(*) as columnCount
	FROM INFORMATION_SCHEMA.COLUMNS
	WHERE table_schema = 'rets'
	AND table_name = '$mainTable'
"));

//turn into collection to retrieve values
$metaNewCount=collect($metaNew)->first()->columnCount;
$metaOldCount=collect($metaOld)->first()->columnCount;

//recreate if counts are different
if($metaNewCount!=$metaOldCount){

	//* notify admin of change * //
	//***************************//



	

	//set table
	$tableDrop=$mainTable;
	$thisProcess='metaTable_change';
	//log the tableDrop for progress monitor
	include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableDrop.php");

	//Step 1. drop if exists
	\Schema::connection('rets')
	->dropIfExists($mainTable);
	//Step 2. recreate based on meta
	\DB::connection('rets')
	->statement("
		CREATE TABLE $mainTable
		LIKE $metaTable");

	$insertNow=NULL;
	//log the tableCreate for progress monitor
	include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");

}

