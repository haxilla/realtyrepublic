<?php

//runs attachments through check
foreach($attachments as $the){

	//default variables
	$hasSafe=null;
	$uid=$the['uid'];
	$part=$the['part'];
	$senderAddress=$the['senderAddress'];
	$headerSubject=$the['headerSubject'];
	$attachName=$the['attachName'];
	$encoding=$the['encoding'];

	//loop array included at start of file
	foreach($attachSafe as $safe){
		//default values
		$safeSender=$safe['safeSender'];
		$safeSubject=$safe['safeSubject'];
		$safeFile=$safe['safeFile'];
		$safeExt=$safe['safeExt'];
		$folder=$safe['folder'];
		//compare against safeValues
		if($senderAddress==$safeSender
		&& strpos($headerSubject,$safeSubject)!==false
		&& strpos($attachName,$safeFile)!==false
		&& strpos($attachName,$safeExt)!==false){
			//safe attachfound
			$hasSafe=1;
			//build array
			$safeAttach[]=[
				'uid'				=>$uid,
				'senderAddress'		=>$senderAddress,
				'safeSender'		=>$safeSender,
				'headerSubject'		=>$headerSubject,
				'safeSubject'		=>$safeSubject,
				'attachName'		=>$attachName,
				'safeFile'			=>$safeFile,
				'safeExt'			=>$safeExt,
				'folder'			=>$folder,
				'encoding'			=>$encoding,
				'part'				=>$part,
			];
		}
	}

	if(!$hasSafe){
		$unsafeAttach[]=[
				'uid'				=>$uid,
				'senderAddress'		=>$senderAddress,
				'headerSubject'		=>$headerSubject,
				'attachName'		=>$attachName,
		];
	}
}