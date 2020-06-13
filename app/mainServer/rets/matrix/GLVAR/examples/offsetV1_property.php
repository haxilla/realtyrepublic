<?php

Use App\models\admin\retsLog;

include(app_path().'/rets/includes/login.php');

$maxrows2 = true;
$offset = 0;
$cumulativeResult=0;
ini_set('max_execution_time', 1200);
//converting to UTC for datefield searches
$theTimeStamp=\Carbon\Carbon::now('UTC')->format("c");
//example search by Date
$theDate=\Carbon\Carbon::now('UTC')->subdays('7')->format("c");
$theDateString=\Carbon\Carbon::now('UTC')->format('YmdHis');
$theDateFolder=\Carbon\Carbon::now('UTC')->format('Ymd');
//example search by Email
$theEmail='lvross10@gmail.com';

//Step 1.
//drop arch table
\Schema::dropIfExists('rets_property_listing_arch');
//Step 2.
//recreate arch table
\DB::statement('
	CREATE TABLE rets_property_listing_arch 
	LIKE rets_property_listing');
//Step 3.
//insert current rets_property_listing into arch
\DB::statement('
	INSERT INTO rets_property_listing_arch
	SELECT * FROM rets_property_listing');
//Step 4.
//drop rets_property_listing
\Schema::dropIfExists('rets_property_listing');
//Step 5.
//create table rets_property_listing like arch
//recreate arch table
\DB::statement('
	CREATE TABLE rets_property_listing 
	LIKE rets_property_listing_arch');
//set loopCount
$loopCount=0;
//loop through & get all records
while($maxrows2){
	$loopCount++;
	//the rets search
	$propertySearch = $rets->Search('Property', 'Listing',
		"(Matrix_Unique_ID=0+)", [
		'Format' 	=> 'COMPACT-DECODED',
		'Limit'		=> '2000', //Limit NONE causes error - Limit 2000 runs
		'Offset'		=> $offset,
		//'Select'		=> 'Matrix_Unique_ID,PublicRemarks'
	]);
	//
	$offset = $offset + count($propertySearch);
	// return the total number of results found (reported by the RETS server)
	$totalResults=$propertySearch->getTotalResultsCount();
	// return the count of results actually retrieved by PHRETS
	$returnedResults=$propertySearch->getReturnedResultsCount(); // same as: count($results)
	// add to last record count
	$cumulativeResult=$cumulativeResult+$returnedResults;
	// stop when records match
	if($cumulativeResult>=$totalResults){
		$maxrows2=false;
	}
	//does filename exist
	if (file_exists(app_path()."/rets/files/propertySearch$loopCount.csv")) {

		if(!is_dir(app_path()."/rets/files/property/$theDateFolder")){
			mkdir(app_path()."/rets/files/property/$theDateFolder", 0777, true);}
		//if so get date & append old filename with date
		rename(app_path()."/rets/files/propertySearch$loopCount.csv",
		app_path()."/rets/files/property/$theDateFolder/propertySearch$loopCount-$theDateString.csv");
		/*
		//delete old file
		unlink(app_path()."/rets/files/propertySearch$loopCount.csv");
		*/
	}

	// export the results in CSV format
	$theFile=$propertySearch->toCSV();
	//save new file
	file_put_contents(app_path()."/rets/files/propertySearch$loopCount.csv", $theFile);

	$pdo = \DB::connection()->getPdo();
	//load data 
	//for linux created file only use \n for line endings
	//for windows created files \r\n
	$pdo->exec("
		LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/files/propertySearch$loopCount.csv'
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