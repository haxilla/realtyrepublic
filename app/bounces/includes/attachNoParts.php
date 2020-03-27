<?php

//loop dparameters
foreach($struct->dparameters as $attached){
	
	if($attached->attribute=='FILENAME'){
		$attachName=$attached->value;}

	if($attachName){
		$attachments[]=[
			'uid'				=>$uid,
			'senderAddress'		=>$senderAddress,
			'headerSubject'		=>$headerSubject,
			'attachName'		=>$attachName,
			'encoding'			=>$struct->encoding,
			'part'				=>1,
		];}
}
//error if no attachName found
if(!$attachName){
	dd('error-line21-attachNoParts.php');}