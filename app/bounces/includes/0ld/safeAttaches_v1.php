<?php

//get headers
$headers=imap_header($mbox, $uid, FT_UID);
$fromAddress=$headers->fromaddress;
$senderAddress=$headers->senderaddress;
$subject=$headers->subject;

$safeValues=([
	'fromAddress'	=>'',
	'senderAddress'	=>'',
	'emailSubject'	=>'',
])

if($fromAddress=='noreply-dmarc-support@google.com'
&& $senderAddress=='noreply-dmarc-support@google.com'
&& strpos($subject,'Submitter: google.com Report-ID:')!==false){
	$safe=1;}