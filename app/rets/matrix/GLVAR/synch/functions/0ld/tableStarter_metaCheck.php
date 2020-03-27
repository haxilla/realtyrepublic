<?php

include('tableStarter_home.php');

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
$metaNew=collect($metaNew);
$metaOld=collect($metaOld);
//get counts
$metaNewCount=$metaNew->first()->columnCount;
$metaOldCount=$metaOld->first()->columnCount;
//recreate if counts are different
if($metaNewCount!=$metaOldCount){
	//Step 1. drop if exists
	\Schema::connection('rets')
	->dropIfExists($mainTable);
	//Step 2. recreate based on meta
	\DB::connection('rets')
	->statement("
		CREATE TABLE $mainTable
		LIKE $metaTable");}