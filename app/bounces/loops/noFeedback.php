<?php

foreach($noFeedback as $no){

	//defaults
	$thisSubject=$no['subject'];
	$uid=$no['uid'];
	$to=$no['to'];
	$from=$no['from'];
	$personalTo=null;
	$personalFrom=null;
	$senderHost=null;
	$date=null;

	//more imap stuff
	$moreInfo=imap_header($mbox,$uid,FT_UID);
	$structure=imap_fetchstructure($mbox,$uid,FT_UID);

	//date
	if(isset($moreInfo->date)){
		$date=$moreInfo->date;}
	
	if(isset($moreInfo->to)){
		foreach($moreInfo->to as $person){
			if(isset($person->personal)){
				$personalTo=$person->personal;}}}
	
	if(isset($moreInfo->from)){
		foreach($moreInfo->from as $person){
			if(isset($person->personal)){
				$personalFrom=$person->personal;}}}

	if(isset($moreInfo->sender)){
		foreach($moreInfo->sender as $sender){
			if(isset($sender->host)){
				$senderHost=$sender->host;}}}

	
	if(//or
		(stripos($thisSubject,'RE:')!==false
		||stripos($thisSubject,'FWD:')!==false
		||$personalTo)
		//and
		&& !stripos($senderHost,'.ru')!==false){
		//put in inbox
		$inbox[]=[
			'to'			=> $to,
			'from'			=> $from,
			'date'			=> $date,
			'uid'			=> $uid,
			'subject'		=> $thisSubject,
			'personalTo'	=> $personalTo,
			'personalFrom'	=> $personalFrom,
			'moreInfo'		=> $moreInfo,
			'structure'		=> $structure,
		];
	}else{
		//put in spam
		$spam[]=[
			'to'			=> $to,
			'from'			=> $from,
			'uid'			=> $uid,
			'subject'		=> $thisSubject,
			'personalTo'	=> $personalTo,
			'personalFrom'	=> $personalFrom,
			'moreInfo'		=> $moreInfo,
			'structure'		=> $structure,
		];
	}
}