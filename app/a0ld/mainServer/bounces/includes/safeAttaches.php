<?php

//get headers
$headers=imap_header($mbox, $uid, FT_UID);
$senderAddress=$headers->senderaddress;
$subject=$headers->subject;

dd('are u here?');

$safeValues=(
	[
		'senderAddress'	=>'noreply-dmarc-support@google.com',
		'emailSubject'	=>'Submitter: google.com Report-ID:'
	],
	//new values here in []
	//[]
);

foreach($safeValue as $the){
	//set values from array
	$safeFrom=$the['fromAddress'];
	$safeSender=$the['senderAddress'];
	$safeSubject=$the['emailSubject'];

	if($senderAddress=='noreply-dmarc-support@google.com'
	&& strpos($subject,'Submitter: google.com Report-ID:')!==false){
		$safe=1;}
}

dd($safe);

