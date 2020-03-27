
<?php

ini_set('max_execution_time', 1200);

//login to start
include('credentials.php');

//sets variable $theSearch
include("searches/search_all.php");

//set offset
$offset = $offset + count($theSearch);
// return the total number of results found (reported by the RETS server)
$retsTotalCount=$theSearch->getTotalResultsCount();
// return the count of results actually retrieved by PHRETS
$returnedResults=$theSearch->getReturnedResultsCount(); // same as: count($results)
// add to last record count
$cumulativeResult=$cumulativeResult+$returnedResults;
// export the results in CSV format
$theFile=$theSearch->toCSV();
//set directories
include('functions/setDirectories.php');
//save new file
file_put_contents(app_path()."/rets/$retsSystem/$mlsName/files/$thisSynch/$fileName", $theFile);

// stop when records match
if($cumulativeResult>=$retsTotalCount){
	$maxrows2=false;}

if($loopCount==1){
	include("log/totalCount.php");}