WEEE5EW<?php

Use App\models\admin\retsLog;

include(app_path().'/rets/includes/login.php');

$maxrows2 = true;
$offset = 0;
$cumulativeResult=0;
//converting to UTC for datefield searches
$theTimeStamp=\Carbon\Carbon::now('UTC')->format("c");
//example search by Date
$theDate=\Carbon\Carbon::now('UTC')->subdays('7')->format("c");
$theDateString=\Carbon\Carbon::now('UTC')->format('YmdHis');
//example search by Email
$theEmail='lvross10@gmail.com';

//does filename exist
if (file_exists(app_path().'/rets/files/propertySearch.csv')) {
	//if so get date & append old filename with date
	rename(app_path().'/rets/files/propertySearch.csv',
	app_path()."/rets/files/propertySearch-$theDateString.csv");}

//loop through & get all records
while($maxrows2){
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

	// export the results in CSV format
	$theFile=$propertySearch->toCSV();
	//save new file
	file_put_contents(app_path()."/rets/files/propertySearch.csv", $theFile, FILE_APPEND);

	echo $offset.' '.$cumulativeResult.'<br>';

}

$pdo = \DB::connection()->getPdo();
//load data 
//for linux created file only use \n for line endings
//for windows created files \r\n
$pdo->exec("
	LOAD DATA LOCAL INFILE '/var/www/html/larasites/realtyrepublic/app/rets/files/propertySearch.csv'
	INTO TABLE rets_property_listing
	FIELDS TERMINATED BY ',' 
	ENCLOSED BY '\"' 
	LINES TERMINATED BY '\\n'
	IGNORE 1 LINES
");

retsLog::create([
	'resource'			=> 'property',
	'class'				=> 'listing',
	'recordCount'		=> $cumulativeResult,
	'theField'			=>	'MatrixModified',
	'theTimeStamp'		=> $theTimeStamp,
]);