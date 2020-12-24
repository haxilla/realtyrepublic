<?php

Use App\bounces\models\bounceReview;
Use App\bounces\models\bounceMessage;

//get uid
$uid=request('uid');
$msgIDLink=request('msgIDLink');

//error if none
if(!$uid && !$msgIDLink){
	dd('error-line7-bounceReview.php');}

if($uid){
	//returns $fullDigitDate to use for msgID
	include(app_path().'/functions/dateDoubleDigits.php');
	$msgID=$fullDigitDate;

	//functions for more info on UID
	include('streams/imap_uid.php');

	//creates htmlmessage/plainmessage
	include('streams/fetchStructure.php');

	//get variables from imap_header function
	include('variables/imap_header_variables.php');

	//emailfinder
	include('functions/email_finder.php');

	//check entries by mailbox&host
	//from headers
	foreach($headerArrayLoop as $thisLoop){
		include('loops/headerLoop.php');}

	//import all loops above into database
	//	$toLoop_Data,$fromLoop_Data,
	//	$replyToLoop_Data,$senderLoop_Data,
	//  $emailsFound
	foreach($importLoop as $import){
		include('functions/importBounceReview.php');}

	//mark to delete & expunge
	imap_delete($mbox,$uid,FT_UID);
	imap_expunge($mbox);
	imap_close($mbox);}

//	if msgID is already set
//	pull record by msgID
if($msgIDLink){
	$theMsgID=$msgIDLink;}

$bounceReviews=bounceReview::where('msgID','=',$theMsgID)
->get();
$bounceMessage=bounceMessage::where('msgID','=',$theMsgID)
->first();

if(!isset($num_msg)){
	$num_msg=bounceReview::count();}