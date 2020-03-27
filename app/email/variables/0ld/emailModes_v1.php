<?php
use App\models\admin\adminOption;

if(isset($theEmail)){
	$toEmail=$theEmail;
	$liveEmail=$theEmail;}

if(isset($agtEmail)){
	$toEmail=$agtEmail;
	$liveEmail=$agtEmail;}

$toName=$agtFirst;
//retain Origin Value in live

$liveName=$toName;
//get Mode
$getEmailMode=adminOption::first();
$emailMode=$getEmailMode['emailMode'];
//if not LIVE change to test email
if($emailMode!=='LIVE'){
	$toEmail='realtyemails@gmail.com';
	$toName='Chris Mistretta';}