<?php

foreach($safeAttach as $the){

	//default vars
	$folder=$the['folder'];
	$uid=$the['uid'];
	$attachName=$the['attachName'];
	$outfileName=str_replace('.gz','',$attachName); 
	$encoding=$the['encoding'];
	$part=$the['part'];
	$downloadFolder=app_path().'/bounces/attachments/'.$folder;
	$extractFolder=$downloadFolder.'/extracts';
	$fullDownloadPath=$downloadFolder."/$attachName";
	$fullOutfilePath=$extractFolder."/$outfileName";

	//fetch contents for this UID
	$fileContents = imap_fetchbody($mbox,$uid,$part,FT_UID);
	//error if none
	if(!$fileContents){
		dd('error-line21-attachmentDownload.php');}
	//detect encoding
	if($encoding == 3) {
		$fileContents=base64_decode($fileContents);
	}elseif($encoding == 4){	
		$fileContents=quoted_printable_decode($fileContents);
	}else{
		dd($encoding,'error-line28-attachmentDownload.php');}

	//create directory if needed
	if(!is_dir($downloadFolder)){
		mkdir($downloadFolder, 0777, true);}

	//put file
	file_put_contents($fullDownloadPath, $fileContents);

	//pathinfo
	$pathinfo=pathinfo($fullDownloadPath);
	//get extension
	$ext=$pathinfo['extension'];
	//if zip
	if($ext=='zip'){
		//start zip
		$zip = new ZipArchive;
		//check
		if ($zip->open($fullDownloadPath) === TRUE){
			//create directory if needed
			if(!is_dir($extractFolder)){
				mkdir($extractFolder, 0777, true);}
			//extract
			$extracted=$zip->extractTo($extractFolder);
			$zip->close();
			//error if issue
			if(!$extracted){
				dd('error-line55-attachmentDownload.php');}

			//mark this for deletion
			imap_delete($mbox, $uid, FT_UID);

		}else{
			dd('error-line57-attachmentDownload.php');}

	}elseif($ext=='gz'){
		//variables
		$zipped = file_get_contents($fullDownloadPath);
		$unzipped = gzdecode($zipped);
		//if ok, make dir & save
		if($unzipped){
			//create directory if needed
			if(!is_dir($extractFolder)){
				mkdir($extractFolder, 0777, true);}
			//save
			if(file_put_contents($fullOutfilePath,$unzipped)){
				//mark this for deletion
				imap_delete($mbox, $uid, FT_UID);
			}else{
				dd('file_put_contents error-line77-attachmentDownload.php');};
			
		}else{
			dd('gzdecode error-line80-attachmentDownload.php');}
		
	}else{
		dd('Unknown extension error-line83-attachmentDownload.php');}
}