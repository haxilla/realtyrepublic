<?php

//check url variable
$thisRecord=request('thisRecord');
$nextRecord=null;
//set default if none
//thisRecord
if(!$thisRecord){
	$thisRecord=0;}

//Logging - checks logs for retsLoop
include("log/checkLogAjax.php");
//table names to compare
$nowHomes=$mlsName.'homes';
$oldHomes=$nowHomes."_backup";
//homePrice
if($retsLoop=='homePrice'){
	//set class
	$retsClass='homes';
	//Query
	include("homes/mysql/homePriceQuery.php");
	//Loop
	include("homes/homePriceLoop.php");
	//Updates & sends JSON
	include("homes/json/homePriceJSON.php");

//homeStatus
}elseif($retsLoop=='homeStatus'){
	//set class
	$retsClass='homes';
	//Query
	include("homes/mysql/homeStatusQuery.php");
	//Loop
	include("homes/homeStatusLoop.php");
	//Updates & sends JSON
	include("homes/json/homeStatusJSON.php");

//New Listings
}elseif($retsLoop=='homeNew'){
	//set class
	$retsClass='homes';
	//Query
	include("homes/mysql/homeNewQuery.php");
	//Loop
	include("homes/homeNewLoop.php");
	//Updates & sends JSON
	include("homes/json/homeNewJSON.php");

//Removed Listings
}elseif($retsLoop=='homeRemoved'){
	//set class
	$retsClass='homes';
	//Query
	include("homes/mysql/homeRemovedQuery.php");
	//Loop
	include("homes/homeRemovedLoop.php");
	//Updates & sends JSON
	include("homes/json/homeRemovedJSON.php");

}elseif($retsLoop=='homeSynchEnd'){

	include("log/homeSynchEnd.php");

}elseif($retsLoop=='agentNew'){
	//set class
	$retsClass='agents';

	//  **  STARTING agentSynch  **  //
	include("log/agentSynchStart.php");
	// ****************************  //

	//Query
	include("agents/mysql/agentNewQuery.php");
	//Loop
	include("agents/agentNewLoop.php");
	//Updates & sends JSON
	include("agents/json/agentNewJSON.php");

}elseif($retsLoop=='agentEmail'){
	//set class
	$retsClass='agents';
	//Query
	include("agents/mysql/agentEmailQuery.php");
	//Loop
	include("agents/agentEmailLoop.php");
	//Updates & sends JSON
	include("agents/json/agentEmailJSON.php");

}elseif($retsLoop=='agentOffice'){
	//set class
	$retsClass='agents';
	//Query
	include("agents/mysql/agentOfficeQuery.php");
	//Loop
	include("agents/agentOfficeLoop.php");
	//Updates & sends JSON
	include("agents/json/agentOfficeJSON.php");

}elseif($retsLoop=='agentPhoto'){
	//set class
	$retsClass='agents';
	//Query
	include("agents/mysql/agentPhotoQuery.php");
	//Loop
	include("agents/agentPhotoLoop.php");
	//Updates & sends JSON
	include("agents/json/agentPhotoJSON.php");

}else{

	dd('error-line30-retsCompareAjax.php');}
