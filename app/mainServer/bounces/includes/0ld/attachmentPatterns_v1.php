<?php

$struct = imap_fetchstructure($mbox, $uid, FT_UID);
$safe=0;

if($struct->ifdparameters){

	//get headers
	$headers=imap_header($mbox, $uid, FT_UID);
	$fromAddress=$headers->fromaddress;
	$senderAddress=$headers->senderaddress;
	$subject=$headers->subject;

	if($fromAddress=='noreply-dmarc-support@google.com'
	&& $senderAddress=='noreply-dmarc-support@google.com'
	&& strpos($subject,'Submitter: google.com Report-ID:')!==false){
		$safe=1;}

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
			if($struct->encoding == 3) {
				$fileContents=base64_decode($fileContents);
            }elseif($struct->encoding == 4){	
  				$fileContents=quoted_printable_decode($fileContents);}

			$filePath='/var/www/html/larasites/realtyrepublic/app/bounces/attachments/dmarc';
			$fullFilePath=$filePath."/googleDmarc_".uniqid().".zip";
			//if fileName contains 
			if(strpos($fileName,"google.com!")!==false
			&& strpos($fileName,".zip")!==false){

				file_put_contents($fullFilePath, $fileContents);

				$zip = new ZipArchive;
				if ($zip->open($fullFilePath) === TRUE) {
				    $zip->extractTo($filePath);
				    $zip->close();
				    echo 'ok';
				} else {
				    echo 'failed';
				}
			}
		}

		exit();

	}
}