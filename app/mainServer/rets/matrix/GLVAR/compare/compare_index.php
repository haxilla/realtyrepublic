<?php

//checks logs for retsLoop
include("compare_checklog.php");

$startLogName=$retsClass.'_compareStart';
$endLogName=$retsClass.'_compareEnd';

if($retsLoop==$startLogName){
	$startLogPath="compareLog_startClass.php";
	include($startLogPath);

}elseif($retsLoop==$endLogName){
	$endLogPath="compareLog_endClass.php";
	include($endLogPath);

}else{

	// table names
	// ex. $nowHomes=GLVAR_Homes
	${'now'.$retsClass} = $mlsName.'_'.$retsClass;
	// ex. $oldHomes=GLVAR_Homes_backup
	${'old'.$retsClass} = $mlsName.'_'.$retsClass."_backup";
	//set files
	$theQueryFile = "$retsClass/mysql/$retsLoop".'Query.php';
	//Query
	include($theQueryFile);
	//Loop
	include("compare_loop.php");
	//Updates & sends JSON
	include("compare_JSON.php");
	
}
