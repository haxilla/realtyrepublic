<?php

Use App\rets\models\retsList;

$retsID=request('retsID');

if(!$retsID){
	dd('error-line7-retsCompare.php');}

//query retsList for mls name
$getRets=retsList::where('retsID','=',$retsID)
->first();

//MLS name variable
$mlsName=$getRets['mlsName'];
$retsSystem=$getRets['retsSystem'];

$officeCompare='officesCompare_'.$retsSystem.'.php';
$agentCompare='agentsCompare_'.$retsSystem.'.php';

$oldAgents=$mlsName.'agents_backup';
$nowAgents=$mlsName.'agents';
$oldOffices=$mlsName.'offices_backup';
$nowOffices=$mlsName.'offices';

//returns homePrice,homeStatus,homeNew,homeRemoved
include(app_path()."/rets/functions/homes/$homeCompare");

//start Log and get new LogID
include("startLog.php");

// **  HOMES  ** //
//insert price change records
include("homes/homePriceLoop.php");

//insert status change records
include("homes/homeStatusLoop.php");

//insert new listings
include("homes/homeNewLoop.php");

//insert removed listings
include("homes/homeRemovedLoop.php");


//   ** AGENTS **  //

//   ** OFFICES ** //

dd($homePrice,$homeStatus,$homeNew,$homeRemoved);