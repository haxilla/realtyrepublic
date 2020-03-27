<?php

//set tables
$backupTable=$mainTable.'_backup';
$synchTable=$mainTable.'_synch';

if(Schema::connection('adre')
->hasTable($mainTable)){
	// Step 1.
	// drop backup table
	\Schema::connection('adre')
	->dropIfExists($backupTable);
	// Step 2.
	// recreate backup table
	\DB::connection('adre')
	->statement("
		CREATE TABLE $backupTable
		LIKE $mainTable");
	// Step 3.
	// Move existing mainTable 
	// into backupTable
	\DB::connection('adre')
	->statement("
		INSERT into $backupTable
		SELECT * FROM $mainTable");
	// drop backup table
	\Schema::connection('adre')
	->dropIfExists($mainTable);
	// recreate main table
	\DB::connection('adre')
	->statement("
		CREATE TABLE $mainTable
		LIKE $backupTable");

	// ***
	// *** table ready for new load data infile
	// *** 

//ELSE issue with tables
}else{

	//notify admin
	dd("error-line24-adre/puppeteer/".$mainTable."Reset.php");}