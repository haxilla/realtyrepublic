<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badSubjectKeys.php');

$badSubject=null;
$thisSubject=$the->subject;

//loop array included at start of file
foreach($badSubjectKeys as $badKey){
	if(stripos($thisSubject, $badKey)!==false){
		$badSubject=1;
		imap_delete($mbox,$uid,FT_UID);
		$badSubjects[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'thisSubject'	=>$thisSubject,
		];
	}
}
