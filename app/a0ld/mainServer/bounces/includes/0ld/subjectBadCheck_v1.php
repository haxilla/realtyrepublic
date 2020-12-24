<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badSubjectKeys.php');

$badFound=null;
//loop array included at start of file
foreach($badSubjectKeys as $badKey){
	if(stripos($thisSubject, $badKey)!==false){
		$badFound=1;
		imap_delete($mbox,$uid,FT_UID);
		$badSubjects[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'thisSubject'	=>$thisSubject,
		];
	}
}

if(!$badFound){
	$okSubjects[]=[
		'uid'			=>$uid,
		'thisSubject'	=>$thisSubject,
	];
}