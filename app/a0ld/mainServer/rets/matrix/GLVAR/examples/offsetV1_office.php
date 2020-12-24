<?php

Use App\models\admin\retsLog;

include(app_path().'/rets/includes/login.php');

$maxrows2 = true;
$offset = 0;
$cumulativeResult=0;
//converting to UTC for datefield searches
$theTimeStamp=\Carbon\Carbon::now('UTC')->format("c");
$theDate=\Carbon\Carbon::now('UTC')->subdays('7')->format("c");
$theDateString=\Carbon\Carbon::now('UTC')->format('YmdHis');
$theDateFolder=\Carbon\Carbon::now('UTC')->format('Ymd');
$theEmail='lvross10@gmail.com';

//drop arch table
\Schema::dropIfExists('rets_office_arch');
//Step 2.
//recreate arch table
\DB::statement('
	CREATE TABLE rets_office_arch 
	LIKE rets_office_office');
//Step 3.
//insert current rets_property_listing into arch
\DB::statement('
	INSERT INTO rets_office_arch
	SELECT * FROM rets_office_office');
//Step 4.
//drop rets_property_listing
\Schema::dropIfExists('rets_office_office');
//Step 5.
//create table rets_property_listing like arch
//recreate arch table
\DB::statement('
	CREATE TABLE rets_office_office 
	LIKE rets_office_arch');

//does filename exist
if (file_exists(app_path()."/rets/files/officeSearch.csv")) {

	if(!is_dir(app_path()."/rets/files/office/$theDateFolder")){
		mkdir(app_path()."/rets/files/office/$theDateFolder", 0777, true);}
	//if so get date & append old filename with date
	rename(app_path()."/rets/files/officeSearch.csv",
	app_path()."/rets/files/office/$theDateFolder/officeSearch-$theDateString.csv");}

while($maxrows2){
	//the rets search
	$officeSearch = $rets->Search('Office', 'Office',
		"(Matrix_Unique_ID=0+)", [
		'Format' 	=> 'COMPACT-DECODED',
		'Limit'		=> 'None',
		'Offset'		=> $offset
	]);
	//
	$offset = $offset + count($officeSearch);
	// return the total number of results found (reported by the RETS server)
	$totalResults=$officeSearch->getTotalResultsCount();
	// return the count of results actually retrieved by PHRETS
	$returnedResults=$officeSearch->getReturnedResultsCount(); // same as: count($results)
	// add to last record count
	$cumulativeResult=$cumulativeResult+$returnedResults;
	// stop when records match
	if($cumulativeResult>=$totalResults){
		$maxrows2=false;
	}

	// export the results in CSV format
	$theFile=$officeSearch->toCSV();
	//save new file
	file_put_contents(app_path()."/rets/files/officeSearch.csv", $theFile, FILE_APPEND);

}

$pdo = \DB::connection()->getPdo();
//load data 
//for linux created file only use \n for line endings
//for windows created files \r\n
$pdo->exec("
	LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/files/officeSearch.csv'
	INTO TABLE rets_office_office
	FIELDS TERMINATED BY ',' 
	ENCLOSED BY '\"' 
	LINES TERMINATED BY '\\n'
	IGNORE 1 LINES
");

retsLog::create([
	'resource'			=> 'office',
	'class'				=> 'office',
	'recordCount'		=> $cumulativeResult,
	'theField'			=>	'MatrixModified',
	'theTimeStamp'		=> $theTimeStamp,
]);

dd('All Done!');