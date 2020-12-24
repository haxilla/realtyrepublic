<?php

$struct = imap_fetchstructure($mbox, $uid, FT_UID);
$safe=0;

//use dates to get dir names
include(app_path().'/functions/directoryByDate.php');
$dateDir=$year.$month;

if(isset($struct->parts)){

	foreach($struct->parts as $part){
		echo "$part->type<br>";}
}

if($struct->ifdparameters){

	//safe attaches
	include('safeAttaches.php');

	//loop dparameters
	foreach($struct->dparameters as $object){
		
		if($object->attribute=='FILENAME'){
			$fileName=$object->value;
		}
		
		$attachments[]=[
			'fileName'	=> $fileName,
			'uid'		=> $uid
		];}

	//if there are attachments, and its safe
	if($attachments && $safe){
		//loop
		foreach($attachments as $the){
			//set fileName
			$fileName=$the['fileName'];
			$uid=$the['uid'];
			$fileContents = imap_fetchbody($mbox,$uid,1,FT_UID);

			//detect encoding
			if($struct->encoding == 3) {
				$fileContents=base64_decode($fileContents);
            }elseif($struct->encoding == 4){	
  				$fileContents=quoted_printable_decode($fileContents);}

  			//set file & path
			$filePath=app_path()."/bounces/attachments/$dateDir/dmarc";
			$fullFilePath=$filePath."/$fileName";

			//if fileName contains 
			if(strpos($fileName,"google.com!")!==false
			&& strpos($fileName,".zip")!==false){

				//create directory if needed
				if(!is_dir($filePath)){
					mkdir($filePath, 0777, true);}

				//put file
				file_put_contents($fullFilePath, $fileContents);
				
				//start zip
				$zip = new ZipArchive;
				//if successful, run more
				if ($zip->open($fullFilePath) === TRUE) {
					//extract
					$extracted=$zip->extractTo($filePath);
					$zip->close();
					//error if issue
					if(!$extracted){
						dd('error-line67-attachmentPatterns.php');}

					//mark this for deletion
					imap_delete($mbox, $uid, FT_UID);

				} else {
					dd('error-line70-attachmentPatterns.php');}
			}
		}
	}
}