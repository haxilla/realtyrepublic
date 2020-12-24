<?php

//default variables
$struct = imap_fetchstructure($mbox, $uid, FT_UID);
$header=imap_header($mbox, $uid, FT_UID);
$senderAddress=$header->senderaddress;
$headerSubject=$header->subject;
$attachName=null;
$unsafeFile=null;

//build attachment array
if(isset($struct->parts)){
	//build attachment array from parts
	include('attachFromParts.php');

}elseif($struct->ifdparameters){
	//build attachment from email with NO parts 
	include('attachNoParts.php');

}elseif(isset($struct->ifdparameters)){
	//no attachment
}else{
	dd('error-line20-attachmentFinder.php');}