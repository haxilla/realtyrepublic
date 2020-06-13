<?php

$synchLoop=true;
$compareLoop=true;
$cronJob=1;

// gets rets system info
include('retsList.php');

// while loops
// synch
while($synchLoop){
	
	//part one
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_cronIndex1.php");
	
	//break out of loop if compare
	if($thisSynch=='Compare'){break;}

	//part 2 - continue if not
	include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_cronIndex2.php");
}

//compare
while($compareLoop){
	include(app_path()."/rets/$retsSystem/$mlsName/compare/compare_index.php");
}

echo "Successful Synch $logID: ".$retsSystem.' '.$mlsName.' '.\Carbon\Carbon::now();



