<?php

Use App\rets\models\retsList;

$retsLoop=request('retsLoop');
$thisRecord=request('thisRecord');

if(!$retsLoop||!$thisRecord){
	dd('error-line9-retsCompareAjax');}

if($retsLoop=='homePrice'){
	//Price Changes
	include("homes/homePriceLoop.php");

}elseif($retsLoop=='homeStatus'){
	//Status Changes
	include("homes/homeStatusLoop.php");

}elseif($retsLoop=='homeNew'){
	//New listings
	include("homes/homeNewLoop.php");

}elseif($retsLoop=='homeRemoved'){
	//Removed listings
	include("homes/homeRemovedLoop.php");

}else{
	dd('error-line30-retsCompareAjax.php');}











//   ** AGENTS **  //

//   ** OFFICES ** //

dd($homePrice,$homeStatus,$homeNew,$homeRemoved);