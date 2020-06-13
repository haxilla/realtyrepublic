<?php

include(app_path().'/functions/dateDoubleDigits.php');
$dateDir=$year.$month;

$attachSafe=array(
	[
		'safeSender'	=>'noreply-dmarc-support@google.com',
		'safeSubject'	=>'Submitter: google.com Report-ID:',
		'safeFile'		=>'google.com!',
		'safeExt'		=>'.zip',
		'folder'		=>$dateDir.'/dmarc/google',
	],
	[
		'safeSender'	=>'noreply@dmarc.yahoo.com',
		'safeSubject'	=>'Submitter: aol.com Report-ID:',
		'safeFile'		=>'aol.com!',
		'safeExt'		=>'.xml.gz',
		'folder'		=>$dateDir.'/dmarc/aol',
	],
	[
		'safeSender'	=>'dmarc_reports@reports.emailsrvr.com',
		'safeSubject'	=>'Submitter: reports.emailsrvr.com Report-ID:',
		'safeFile'		=>'emailsrvr.com!',
		'safeExt'		=>'.zip',
		'folder'		=>$dateDir.'/dmarc/emailsrvr',
	],
	[
		'safeSender'	=>'noreply@dmarc.yahoo.com',
		'safeSubject'	=>'Submitter: yahoo.com Report-ID:',
		'safeFile'		=>'yahoo.com!',
		'safeExt'		=>'.xml.gz',
		'folder'		=>$dateDir.'/dmarc/yahoo',
	],
);