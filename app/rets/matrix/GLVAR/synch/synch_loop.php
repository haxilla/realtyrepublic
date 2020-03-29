<?php

//default variables
$loopCount=0;
$offset = 1;
$cumulativeResult=0;
//maxrows2 set to false when finished
$maxrows2 = true;
$thisProcess="Inserting data from $retsSystem / $mlsName into $mainTable";
$insertNow=$mainTable;
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");

//loop through & get all records
while($maxrows2){
	//increment loop
	$loopCount++;
	//the rets search
	include("synch_results.php");
	//local save
	$pdo = \DB::connection('rets')
	->getPdo();
	//load data
	//for linux created file only use \n for line endings
	//for windows created files \r\n
	$pdo->exec("
		LOAD DATA INFILE '/var/www/html/larasites/realtyemails/app/rets/$retsSystem/$mlsName/files/$thisSynch/$fileName'
		INTO TABLE $mainTable
		FIELDS TERMINATED BY ','
		ENCLOSED BY '\"'
		LINES TERMINATED BY '\\n'
		IGNORE 1 LINES;
	");

	//progress log
	include("log/progressLog.php");
}

$insertNow=NULL;

$thisProcess="$mainTable Complete!";
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");
