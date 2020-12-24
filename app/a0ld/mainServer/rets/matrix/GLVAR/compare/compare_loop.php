<?php
//include class specific file
include("variables/mainVars.php");
//reset counter
$loopCount=0;
// remove time limit
ini_set('max_execution_time', '0'); // for infinite time of execution 
//run loop
foreach($theQuery as $the){
	//increment & set looping vars
	include("compare_variables_loop.php");
	//changeLog
	include($changeLogPath);
	//history
	include("compareLog_history.php");
	//progressLog
	include("progress/updateLog.php");
}

//count for this query
$totalCountVar="$retsLoop".'Count';
