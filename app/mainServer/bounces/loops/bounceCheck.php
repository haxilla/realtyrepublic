<?php

Use App\bounces\models\bounceWorksheet;
Use App\adre\models\adreAgent;

$bounceCheck=bounceWorksheet::whereNull('adreFound')
->orWhereNull('memberFound')
->orWhereNull('distroFound')
->get();

$adreFound=array();
$adreNotFound=array();
$memberFound=array();

foreach($bounceCheck as $the){

	//update licNumber
	if(!$the->adreFound){
		include(app_path().'/bounces/check/adre_check.php');}

	//update eidx
	if(!$the->distroFound){
		include(app_path().'/bounces/check/eidx_check.php');}

	//update umid
	if(!$the->memberFound){
		include(app_path().'/bounces/check/member_check.php');}}