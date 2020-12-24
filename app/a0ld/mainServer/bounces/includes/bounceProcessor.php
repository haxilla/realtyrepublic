<?php

//regexes for In-Reply-to, X-Autoreply, Feedback-ID
include(app_path().'/bounces/includes/processPatterns.php');

if($xEnvelopeSender){
	//returns $badEnvelope if found
	include(app_path().'/bounces/check/badEnvelope_check.php');}

if($returnPath){
	//returns $badReturnPath if found
	include(app_path().'/bounces/check/badReturnPath_check.php');}

//returns $badHeader if found
include(app_path().'/bounces/check/badHeader_check.php');

//returns $badSender if found
include(app_path().'/bounces/check/badSender_check.php');

//returns $badSubject if found
include(app_path().'/bounces/check/badSubject_check.php');

//returns $badContent if found
include(app_path().'/bounces/check/badContent_check.php');

//returns $safesender if found
include(app_path().'/bounces/check/safeSender_check.php');

//checks for to & from fields
include(app_path().'/bounces/check/toAndFrom_check.php');

if(($inReplyTo && $toAndFrom && !$attachName
&& !$badSubject && !$badContent)||$xAutoreply){
	$safemail[]=[
		'uid'		=>$uid,
		'to'		=>$to,
		'from'		=>$from,
		'theDate'	=>$the->date,
		'subject'	=>$the->subject,
		'xAutoReply'=>$xAutoreply,];
}elseif($safeSender){
	$reviewmail[]=[
		'uid'		=>$uid,
		'to'		=>$to,
		'from'		=>$from,
		'theDate'	=>$the->date,
		'subject'	=>$the->subject,
		'safeSender'=>$safeSenderFound,
	];
}else{
	$junkmail[]=[
		'uid'			=>$uid,
		'to'			=>$to,
		'from'			=>$from,
		'thedate'		=>$the->date,
		'subject'		=>$the->subject,
		'inReplyTo'		=>$inReplyTo,
		'toAndFrom'		=>$toAndFrom,
		'feedbackFound'	=>$feedbackFound,
		'badSubject'	=>$badSubject,
		'badContent'	=>$badContent,
		'attachName'	=>$attachName,];
}