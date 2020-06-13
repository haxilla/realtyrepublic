<?php

Use App\rets\models\retsList;

$retsID=request('retsID');
$monitor=request('monitor');

if(!$retsID){
	dd('error-line8-retsIDcheck.php');}

//query retsList for mls name
$getRets=retsList::where('retsID','=',$retsID)
->first();

//MLS name variable
$mlsName=$getRets['mlsName'];
$retsSystem=$getRets['retsSystem'];