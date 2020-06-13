<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badEnvelopeKeys.php');

$badEnvelope=null;
$badEnvelopeFound=array();

//loop array included at start of file
foreach($badEnvelopeKeys as $badKey){
	if(stripos($xEnvelopeSender, $badKey)!==false){
		$badEnvelope=1;
		imap_delete($mbox,$uid,FT_UID);
		$badEnvelopeFound[]=[
			'uid'				=>$uid,
			'badKey'			=>$badKey,
			'xEnvelopeSender'	=>$xEnvelopeSender,
			'thisSubject'		=>$the->subject,
		];
	}
}
