<?php

//msg
$uid=request('uid');

//error if none
if(!$uid){
	dd('error-line8-bounceDisplay');}

//open stream
include('streams/realtye-mails_inbox.php');

//set message count
$msgCount=$num_msg;

//imap functions
include('streams/imap_uid.php');

//creates htmlmessage/plainmessage
include('streams/fetchStructure.php');

//close connection      
imap_close($mbox);