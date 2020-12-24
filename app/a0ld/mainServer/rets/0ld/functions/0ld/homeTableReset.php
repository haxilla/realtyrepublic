<?php

//Step 1.
//drop arch table
\Schema::connection('rets')
->dropIfExists($backupTable);

//Step 2.
//recreate arch table
\DB::statement('
	CREATE TABLE $backupTable
	LIKE $mainTable');

//Step 3.
//insert current into arch
\DB::statement('
	INSERT INTO $backupTable
	SELECT * FROM $mainTable');

//Step 4.
//drop rets_property_listing
\Schema::dropIfExists($mainTable);

//Step 5.
//create current table like arch
//recreate arch table
\DB::statement('
	CREATE TABLE $mainTable
	LIKE $backupTable');