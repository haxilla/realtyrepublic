<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badReturnPathKeys.php');

$badReturn=null;

//loop array included at start of file
foreach($badReturnPathKeys as $badKey){
	if(stripos($returnPath, $badKey)!==false){
		$badReturn=1;
		imap_delete($mbox,$uid,FT_UID);
		$badReturnPathFound[]=[
			'uid'				=>$uid,
			'badKey'			=>$badKey,
			'returnPath'		=>$returnPath,
			'thisSubject'		=>$the->subject,
		];
	}
}
