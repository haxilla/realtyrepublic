<?php

Use App\rets\models\retsList;

//check url variable
$thisRecord=request('thisRecord');
$nextRecord=null;
//set default if none
//thisRecord
if(!$thisRecord){
	$thisRecord=0;}

//Logging - checks logs for retsLoop
include("log/checkLogAjax.php");

//homePrice
if($retsLoop=='homePrice'){
	//table names to compare
	$retsClass='homes';
	$nowHomes=$mlsName.$retsClass;
	$oldHomes=$nowHomes."_backup";
	//Query
	include("homes/mysql/homePriceQuery.php");
	//Loop
	include("homes/homePriceLoop.php");
	//Updates & sends JSON
	include("homes/json/homePriceJSON.php");

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