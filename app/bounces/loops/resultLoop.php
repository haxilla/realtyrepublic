<?php

// ** result=$mbox stream ** //
foreach($result as $the){
	// default variables
	$msg=$the->msgno;
	$uid=$the->uid;
	$emailCount=0;
	$distroCount=0;
	$attachCount=0;
	
	// bounced email finder
	include(app_path().'/bounces/includes/bouncePatterns.php');

	//attachments
	include(app_path().'/bounces/includes/attachmentFinder.php');

	//subject check
	include(app_path().'/bounces/includes/subjectCheck.php');

	//auto-replies
	include(app_path().'/bounces/includes/autoreplyPatterns.php');
	
	// get thisEmail
	// sets distroFound Array
	include(app_path().'/bounces/includes/thisEmail.php');

	// set bounceArrays
	include(app_path().'/bounces/includes/bounceArray.php');

	// process safemail & junkmail
	include(app_path().'/bounces/includes/bounceProcessor.php');

	if(!$emailCount){
		$noEmail[]=['msg'=>$msg,];}}