<?php

//default variables
$offset = 0;
$cumulativeResult=0;
ini_set('max_execution_time', 1200);

//login to start
include('credentials.php');

//sets variable $theSearch
include('queries/homes_all.php');

//set offset
$offset = $offset + count($theSearch);
// return the total number of results found (reported by the RETS server)
$totalResults=$theSearch->getTotalResultsCount();
// return the count of results actually retrieved by PHRETS
$returnedResults=$theSearch->getReturnedResultsCount(); // same as: count($results)
// add to last record count
$cumulativeResult=$cumulativeResult+$returnedResults;
// export the results in CSV format
$theFile=$theSearch->toCSV();