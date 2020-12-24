<?php

//extract emails from emailheaders
$headerArrayLoop=array(
	'toLoop','fromLoop','replyToLoop','senderLoop',);
//put arrays into database
$importLoop=array('toLoop_Data','fromLoop_Data',
	'replyToLoop_Data','senderLoop_Data','emailsFoundArray');

//set default _Data arrays
$toLoop_Data=null;
$fromLoop_Data=null;
$replyToLoop_Data=null;
$senderLoop_Data=null;

//header values
$msgDate=$imap_header->date;
$subject=$imap_header->subject;
$message_id=$imap_header->message_id;
$toaddress=$imap_header->toaddress;
$toArray=$imap_header->to;
$fromaddress=$imap_header->fromaddress;
$fromArray=$imap_header->from;
$replytoaddress=$imap_header->reply_toaddress;
$replyToArray=$imap_header->reply_to;
$senderaddress=$imap_header->senderaddress;
$senderArray=$imap_header->sender;
$personal=null;
$mailbox=null;
$host=null;
$checkEmail=null;


//* toArray *//
//***********//
foreach($toArray as $to){

	if(isset($to->personal)){
		$personal=$to->personal;}
	if(isset($to->mailbox)){
		$mailbox=$to->mailbox;}
	if(isset($to->host)){
		$host=$to->host;}

	if($mailbox && $host){
		$checkEmail=$mailbox.'@'.$host;
		include(app_path().'/bounces/check/theMsgID_check.php');}

	$toLoop[]=[
		'theMsgID'		=>$theMsgID,
		'checkEmail'	=>$checkEmail,
		'personal'		=>$personal,
		'mailbox'		=>$mailbox,
		'host'			=>$host,];}

//* fromArray *//
//***********//
foreach($fromArray as $from){

	if(isset($from->personal)){
		$personal=$from->personal;}
	if(isset($from->mailbox)){
		$mailbox=$from->mailbox;}
	if(isset($from->host)){
		$host=$from->host;}

	if($mailbox && $host){
		$checkEmail=$mailbox.'@'.$host;
		include(app_path().'/bounces/check/theMsgID_check.php');}

	$fromLoop[]=[
		'checkEmail'	=>$checkEmail,
		'theMsgID'		=>$theMsgID,
		'personal'		=>$personal,
		'mailbox'		=>$mailbox,
		'host'			=>$host,];}

//* replytoArray *
//****************
foreach($replyToArray as $replyTo){

	if(isset($replyTo->personal)){
		$personal=$replyTo->personal;}
	if(isset($replyTo->mailbox)){
		$mailbox=$replyTo->mailbox;}
	if(isset($replyTo->host)){
		$host=$replyTo->host;}

	if($mailbox && $host){
		$checkEmail=$mailbox.'@'.$host;
		include(app_path().'/bounces/check/theMsgID_check.php');}

	$replyToLoop[]=[
		'checkEmail'	=>$checkEmail,
		'theMsgID'		=>$theMsgID,
		'personal'		=>$personal,
		'mailbox'		=>$mailbox,
		'host'			=>$host,];}

//* senderArray *//
//***************//
foreach($senderArray as $sender){

	if(isset($sender->personal)){
		$sender_personal=$sender->personal;}
	if(isset($sender->mailbox)){
		$sender_mailbox=$sender->mailbox;}
	if(isset($sender->host)){
		$sender_host=$sender->host;}

	if($mailbox && $host){
		$checkEmail=$mailbox.'@'.$host;
		include(app_path().'/bounces/check/theMsgID_check.php');}

	$senderLoop[]=[
		'checkEmail'	=>$checkEmail,
		'theMsgID'		=>$theMsgID,
		'personal'		=>$personal,
		'mailbox'		=>$mailbox,
		'host'			=>$host,];}