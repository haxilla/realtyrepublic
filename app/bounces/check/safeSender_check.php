<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/safeSenderKeys.php');

$safeSender=null;
$thisSubject=$the->subject;
$thisFrom=$the->from;
//loop array included at start of file
foreach($safeSenderKeys as $safeKey){
	if(stripos($thisFrom, $safeKey)!==false){
		$safeSender=1;
		$safeSenderFound[]=[
			'uid'			=>$uid,
			'safeKey'		=>$safeKey,
			'thisFrom'		=>$thisFrom,
			'thisSubject'	=>$thisSubject,
		];
	}
}
