<?php

Use App\rets\models\retsList;

//get URL variables
$retsLoop=request('retsLoop');
//error if none
if(!$retsLoop){
	dd('error-line10-retsCompareAjax');}

//check url variable
$thisRecord=request('thisRecord');

//set default if none
//thisRecord
if(!$thisRecord){
	$thisRecord=0;}

//homePrice
if($retsLoop=='homePrice'){
	//table names to compare
	$retsClass='homes';
	$nowHomes=$mlsName.$retsClass;
	$oldHomes=$nowHomes."_backup";
	//Query
	include("homes/mysql/homePriceQuery.php");
	/* ONE AT A TIME FOR LARGE SEARCH

	//set as collection
	$homePrice=collect($homePrice);

	//count records
	$homePriceCount=$homePrice->count();

	//Get One Record
	$homePrice=$homePrice->slice($thisRecord,1);

	//Set Next Record
	$nextRecord=$thisRecord+1;
	*/

	//Logging
	include("log/checkLogAjax.php");
	//Loop
	include("homes/homePriceLoop.php");
	//log updates
	include("log/homePriceLog.php");
	//log synch progress
	include("log/synchLogAjax.php");
	//output json & exit
	$idArray = array(
		'ajaxResponse'		=> 1,
		'logID'				=> $logID,
		'retsID'			=> $retsID,
		'retsLoop'			=> $retsLoop,
		'retsClass'			=> $retsClass,
		'nowHomes'			=> $nowHomes,
		'oldHomes'			=> $oldHomes,
		'lowerCount'		=> $lowerCount,
		'raiseCount'		=> $raiseCount,
		'changeType'		=> $changeType,
		'thisRecord'		=> $thisRecord,
		'nextRecord'		=> $nextRecord,
		'homePriceCount'	=> $homePriceCount,
	);

	echo json_encode($idArray);
	exit();

//homeStatus
}elseif($retsLoop=='homeStatus'){
	//Query
	include("homes/mysql/homeStatusQuery.php");
	//Loop
	include("homes/homeStatusLoop.php");

//New Listings
}elseif($retsLoop=='homeNew'){
	//Query
	include("homes/mysql/homeNewQuery.php");
	//Loop
	include("homes/homeNewLoop.php");

//Removed Listings
}elseif($retsLoop=='homeRemoved'){
	//Query
	include("homes/mysql/homeRemovedQuery.php");
	//Loop
	include("homes/homeRemovedLoop.php");

}else{
	dd('error-line30-retsCompareAjax.php');}











//   ** AGENTS **  //

//   ** OFFICES ** //

dd($homePrice,$homeStatus,$homeNew,$homeRemoved);