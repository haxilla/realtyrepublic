<?php

// ** SYNCH START ** //
if($thisSynch=='synchStart'){
	//updates nextSynch
	$nextSynch='Homes';
	$theStatus='Pending';
	include(app_path()."/rets/$retsSystem/$mlsName/synch/log/synch_endLog.php");

//HOMES
}elseif($thisSynch=='Homes'){

	$nextSynch='Agents';
	$searchResource="Property";
	$searchClass="Listing";

//AGENTS
}elseif($thisSynch=='Agents'){

	$nextSynch="Offices";
	$searchResource="Agent";
	$searchClass="Agent";

//OFFICES
}elseif($thisSynch=='Offices'){

	$nextSynch="synchEnd";
	$searchResource="Office";
	$searchClass="Office";

// ** SYNCH END ** //
}elseif($thisSynch=='synchEnd'){

	$nextSynch="Compare";
	$theStatus="Pending";
	//log & exit
	include(app_path()."/rets/$retsSystem/$mlsName/synch/log/synch_endLog.php");

//COMPARE
}elseif($thisSynch=='Compare'){

	$theStatus='Compare';
	//if not cronjob reply & exit
	if(!isset($cronJob)){

		$idArray=array(
		'theStatus'	=> $theStatus,
		'logID'		=> $logID,
		'retsID'	=> $retsID,);

		//reply & exit
		echo json_encode($idArray);
		exit();}

}else{

	//error if unknown 
	dd('error-line55-nextSynch.php');}