<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badContentKeys.php');

$badContent=null;
$badContentFound=array();
$thisContent=imap_body($mbox,$uid,FT_UID);

//loop array included at start of file
foreach($badContentKeys as $badKey){
	if(stripos($thisContent, $badKey)!==false){
		$badContent=1;
		imap_delete($mbox,$uid,FT_UID);
		$badContentFound[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'badContent'	=>$badContent,
			'thisSubject'	=>$thisSubject,
		];
	}
}
