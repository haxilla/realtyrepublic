<?php

//default variables
$offset = 0;
$cumulativeResult=0;
ini_set('max_execution_time', 1200);

//login to start
include(app_path().'/rets/GLVAR/login/credentials.php');

//rets query
$allPropertySearch = $rets->Search('Property', 'Listing',
	"(Matrix_Unique_ID=0+)", [
	'Format' 	=> 'COMPACT-DECODED',
	'Limit'		=> '2000', //Limit NONE causes error - Limit 2000 runs
	'Offset'		=> $offset,
	//'Select'		=> 'Matrix_Unique_ID,PublicRemarks'
]);
//set offset
$offset = $offset + count($allPropertySearch);
// return the total number of results found (reported by the RETS server)
$totalResults=$allPropertySearch->getTotalResultsCount();
// return the count of results actually retrieved by PHRETS
$returnedResults=$allPropertySearch->getReturnedResultsCount(); // same as: count($results)
// add to last record count
$cumulativeResult=$cumulativeResult+$returnedResults;
// export the results in CSV format
$theFile=$allPropertySearch->toCSV();
//set directories
include(app_path().'/rets/GLVAR/functions/setDirectories.php');
//save new file
file_put_contents(app_path()."/rets/GLVAR/files/listings/listings_$loopCount.csv", $theFile);
// stop when records match
if($cumulativeResult>=$totalResults){
	$maxrows2=false;}