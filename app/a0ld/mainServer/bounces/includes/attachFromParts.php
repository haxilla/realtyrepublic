<?php
$i=0;
foreach($struct->parts as $part){
	$i++;
	if($part->ifdparameters){
		foreach($part->dparameters as $attached){
			//set encoding
			$encoding=$part->encoding;
			//check for filename
			if($attached->attribute=='FILENAME'){
				$attachName=$attached->value;}
			//set name & build array
			if($attachName){
				$attachments[]=[
					'uid'				=>$uid,
					'senderAddress'		=>$senderAddress,
					'headerSubject'		=>$headerSubject,
					'attachName'		=>$attachName,
					'encoding'			=>$encoding,
					'part'				=>$i,
				];}}

		//error if no attachName found
		if(!$attachName){
			dd('error-line24-attachFromParts.php');}

	}//end if($part->ifdparameters)
}//end foreach ($struct->parts)