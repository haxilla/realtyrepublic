<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badHeaderKeys.php');

$badHeader=null;
$badHeaderFound=array();

//loop array included at start of file
foreach($badHeaderKeys as $badKey){
	if(stripos($msg_header, $badKey)!==false){
		$badHeader=1;
		imap_delete($mbox,$uid,FT_UID);
		$badHeaderFound[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'badHeader'		=>$badHeader,
			'thisSubject'	=>$thisSubject,
		];
	}
}
