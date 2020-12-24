<?php

//reset listings tables
include(app_path().'/rets/GLVAR/mysql/listings_tableReset.php')

//default variables
$loopCount=0;
//maxrows2 set to false when finished
$maxrows2 = true;
//loop through & get all records
while($maxrows2){
	//increment loop
	$loopCount++;
	//the rets search
	include(app_path().'/rets/GLVAR/retsQueries/allPropertySearch.php');
	//local save
	$pdo = \DB::connection()->getPdo();
	//load data 
	//for linux created file only use \n for line endings
	//for windows created files \r\n
	$pdo->exec("
		LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/GLVAR/files/listings/listings_$loopCount.csv'
		INTO TABLE rets_property_listing
		FIELDS TERMINATED BY ',' 
		ENCLOSED BY '\"' 
		LINES TERMINATED BY '\\n'
		IGNORE 1 LINES;
	");
}

retsLog::create([
	'resource'			=> 'property',
	'class'				=> 'listing',
	'recordCount'		=> $cumulativeResult,
	'theField'			=>	'MatrixModified',
	'theTimeStamp'		=> $theTimeStamp,
]);

dd('all done!');