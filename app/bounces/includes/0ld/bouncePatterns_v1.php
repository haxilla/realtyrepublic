<?php

if(isset($the->subject)){
	$autoSubject=$the->subject;
}else{
	$autoSubject=null;}

if(isset($the->to)){
	$to=$the->to;
}else{
	$to=null;}

if(isset($the->from)){
	$from=$the->from;
}else{
	$from=null;}

$imap_header=imap_header($mbox,$uid,FT_UID);
$imap_qprint_body=imap_qprint(imap_body($mbox,$uid,FT_UID));
$imap_body=imap_body($mbox,$uid,FT_UID);
$imap_fetchbody=imap_fetchbody($mbox,$uid,1.1,FT_UID);
$msg_header=imap_fetchbody($mbox,$uid,0,FT_UID);
$attached_msg_header=imap_fetchbody($mbox,$uid,2,FT_UID);

//final recipient spaces in reges
$pattern = '/Final-Recipient: rfc822; (.*)/';
//set default Array
$finalmatches = Array();
//build matches array
preg_match($pattern, $imap_body, $finalmatches);
//set finalRecipient
if($finalmatches){
	$finalRecipient = $finalmatches[1];
	$finalRecipient = str_replace(array('<','>'),
	'', $finalRecipient);
}else{
	$finalRecipient = null;}

//try with NO spaces in regex
if(!$finalRecipient){
	//set pattern
	$pattern = '/Final-Recipient: rfc822;(.*)/';
	//set array
	$finalmatches = Array();
	//build matches array
	preg_match($pattern, $imap_body, $finalmatches);
	//set Final Recipient
	if($finalmatches){
		$finalRecipient = $finalmatches[1];			
		$finalRecipient = str_replace(array('<','>'),
		'', $finalRecipient);
	}else{
		$finalRecipient = null;}}

//try with NO spaces in regex
if(!$finalRecipient){
	//set pattern
	$pattern = '/Final-Recipient: RFC822; (.*)/';
	//set array
	$finalmatches = Array();
	//build matches array
	preg_match($pattern, $imap_body, $finalmatches);
	//set Final Recipient
	if($finalmatches){
		$finalRecipient = $finalmatches[1];			
		$finalRecipient = str_replace(array('<','>'),
		'', $finalRecipient);
	}else{
		$finalRecipient = null;}}

//original recipient
$pattern = '/Original-Recipient: rfc822;(.*)/';
//set array
$originalmatches = Array();
//build matches array
preg_match($pattern, $imap_body, $originalmatches);
if($originalmatches){
	$originalRecipient = $originalmatches[1];
	$originalRecipient = str_replace(array('<','>'),
	'', $originalRecipient);

}else{
	$originalRecipient=null;}

//Delivered-To
$pattern = '/Delivered-To: (.*)/';
$deliverto_matches = Array();
preg_match($pattern, $imap_body, $deliverto_matches);
if($deliverto_matches){
	$deliverTo = $deliverto_matches[1];
	$deliverTo = str_replace(array('<','>'), '', $deliverTo);
}else{
	$deliverTo = null;}

//Resent-To
$pattern = '/Resent-To: (.*)/';
$resent_to_matches = Array();
preg_match($pattern, $imap_body, $resent_to_matches);
if($resent_to_matches){
	$resentTo = $resent_to_matches[1];
	$resentTo = str_replace(array('<','>'), '', $resentTo);
}else{
	$resentTo = null;}

//Resent-From
$pattern = '/Resent-From: (.*)/';
$resent_from_matches = Array();
preg_match($pattern, $imap_body, $resent_from_matches);
if($resent_from_matches){
	$resentFrom = $resent_from_matches[1];
	$resentFrom = str_replace(array('<','>'), '', $resentFrom);
}else{
	$resentFrom = null;}

//To
$pattern = '/To: (.*)/';
$To_matches = Array();
preg_match($pattern, $imap_body, $To_matches);
if($To_matches){
	$To = $To_matches[1];
	$To = str_replace(array('<','>'), '', $To);
}else{
	$To = null;}

//diagnostic code
$pattern = '/Diagnostic-Code: (.*)/';
$diagCode = Array();
preg_match($pattern, $imap_body, $diagCode);
if($diagCode){
	$diagnostic = $diagCode[1];
}else{
	$diagnostic = null;}

//earthlink spam challenge
$pattern = '/https:\/\/webmail\.pas\.earthlink\.net\/wam\/addme\?a=(.*)/';
$earthlink = Array();
preg_match($pattern, $imap_body, $earthlink);
if($earthlink){
	//original variable has & sign 
	//followed by non-email data
	$earthlink = $earthlink[1];
	//strtok function removes character 
	//and everything beyond
	$earthlink = strtok($earthlink, '&');
	$diagnostic='spam challenge';
}else{
	$earthlink = null;}

//feedbackID
$pattern = '/Feedback-ID: (.*)/';
$feedbackID = Array();
preg_match($pattern, $imap_body, $feedbackID);
if($feedbackID){
	$hasFeedback[] = [
		'to'		=>$to,
		'from'		=>$from,
		'uid'		=>$uid,
		'subject'	=>$autoSubject,
		'FeedbackID'=>$feedbackID[1],
	];
}else{
	$noFeedback[] = [
		'to'		=>$to,
		'from'		=>$from,
		'uid'		=>$uid,
		'subject'	=>$autoSubject
	];
}

//earthlink spam challenge
$pattern = '/In-Reply-To:(.*)/';
$inReplyTo = Array();
preg_match($pattern, $msg_header, $inReplyTo);
if($inReplyTo){
	$hasReplyTo[] = [
		'to'		=> $to,
		'from'		=> $from,
		'msgID'		=> $inReplyTo[1],
		'subject'	=> $autoSubject,
	];
}else{
	$noReplyTo[]=[
		'to' 		=> $to,
		'from'		=> $from,
		'uid'		=> $uid,
		'subject'	=> $autoSubject,
	];
}




