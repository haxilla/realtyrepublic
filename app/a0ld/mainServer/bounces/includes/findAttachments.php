<?php

$struct = imap_fetchstructure($mbox, $msg);
$attachments=array();

if($struct->ifdparameters){

	foreach($struct->dparameters as $object){
		
		if($object->attribute=='FILENAME'){
			$fileName=$object->value;}
		
		$attachments[]=['fileName'=>$fileName,];
	}
}