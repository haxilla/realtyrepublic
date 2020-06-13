<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
ini_set('memory_limit', '512M');


//returns $result
include('streams/realtye-mails_inbox.php');

//set default arrays
include('variables/defaultVariables.php');

//loop over $result array
//returns various arrays
include('loops/resultLoop.php');

//check attachments if found
if($attachments){
	//marks safe downloads
	//returns safeAttach & unsafeAttach
	include('includes/attachmentCheck.php');}

// enters bounce emails found into my
	sql
// and marks to delete on email server
include('loops/distroFound.php');

//if no feedbackID found in email
if($noFeedback){
	include('loops/noFeedback.php');}

//close imap & exit	
imap_expunge($mbox);
$msgCount=imap_num_msg ($mbox);
imap_close($mbox);

dd($safemail,$junkmail);
//query bounceWorksheet
//for missing values
include('loops/bounceCheck.php');