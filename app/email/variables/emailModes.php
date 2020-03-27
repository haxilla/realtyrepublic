<?php
use App\models\admin\adminOption;
//Original Name
$liveEmail	= $trialEmail;
$liveName 	= $agtFullName;
//Actually Sent to
$toEmail 	= $liveEmail;
$toName 		= $liveName;
//get Mode
$getEmailMode=adminOption::first();
$emailMode=$getEmailMode['emailMode'];
//if not LIVE change to test email
if($emailMode!=='LIVE'){
	$toEmail='subscriber2016@yahoo.com';
	$toName='Chris Mistretta';}