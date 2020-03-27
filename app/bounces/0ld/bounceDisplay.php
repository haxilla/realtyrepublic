<?php

//msg
$uid=request('uid');

//error if none
if(!$uid){
	dd('error-line8-bounceDisplay');}

//stream
$mbox = imap_open ("{mail.realtye-mails.com:110/pop3}INBOX", 
	"members@realtye-mails.com", 
	"d4vidb0wi3!");

$msgCount=imap_num_msg ($mbox);

// searches the message to ID 
// most likely email bounce
include('includes/bouncePatterns.php');

//determines if attachments
include('includes/findAttachments.php');

//close connection      
imap_close($mbox);