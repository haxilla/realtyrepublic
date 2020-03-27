<?php 

Use App\models\admin\adminOption;

//query table
$getOptions=adminOption::first();

$emailMode=$getOptions['emailMode'];

if($emailMode!=="LIVE"){
	$toEmail='subscriber2016@yahoo.com';
	$toName='Chris Mistretta';}