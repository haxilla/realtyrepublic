<?php

//array to find bad subjects
include(app_path().'/bounces/arrays/badEmailKeys.php');

$badEmailFound=array();
$badEmail=null;

//loop array included at start of file
foreach($badEmailKeys as $badKey){

	if(stripos($thisEmail, $badKey)!==false){
		$badEmail=1;
		$badEmailFound[]=[
			'uid'			=>$uid,
			'badKey'		=>$badKey,
			'thisEmail'		=>$thisEmail,
			'subject'		=>$subject,
		];
	}
}