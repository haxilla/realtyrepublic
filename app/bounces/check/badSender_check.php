<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badSenderKeys.php');

$badSender=null;
$from=$the->from;

//loop array included at start of file
foreach($badSenderKeys as $badKey){
	if(stripos($from, $badKey)!==false){
		$badSender=1;
		imap_delete($mbox,$uid,FT_UID);
		$badSenderFound[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'from'			=>$from,
			'thisSubject'	=>$the->subject,
		];
	}
}
