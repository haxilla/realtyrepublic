<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
ini_set('memory_limit', '512M');

//connection
include('streams/realtye-mails_inbox.php');

//fetch from stream returns $result
include('streams/fetchOverview.php');

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

// enters bounce emails found into mysql
// and marks to delete on email server
include('loops/distroFound.php');

//close imap & exit	
imap_expunge($mbox);
$msgCount=imap_num_msg ($mbox);
imap_errors();
imap_close($mbox);

//query bounceWorksheet
//for missing values
include('loops/bounceCheck.php');

//dd($bounceArray);