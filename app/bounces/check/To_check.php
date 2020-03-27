<?php
//has quoted printable text
//conversion for certain
//malformed emails

//QPD with space after colon
$pattern = '/To: (.*)/';
$To_qpd_matches = Array();
$imap_qpd_body=quoted_printable_decode($imap_body);
preg_match($pattern, $imap_qpd_body, $To_qpd_matches);
if($To_qpd_matches){
	$To_qpd = $To_qpd_matches[1];
	$To_qpd = str_replace(array('<','>'), '', $To_qpd);
}else{
	$To_qpd = null;}

//if not set above, try again
if(!$To_qpd){
	//QPD no space after colon
	$pattern = '/To:(.*)/';
	$To_qpd_matches = Array();
	$imap_qpd_body=quoted_printable_decode($imap_body);
	preg_match($pattern, $imap_qpd_body, $To_qpd_matches);
	if($To_qpd_matches){
		$To_qpd = $To_qpd_matches[1];
		$To_qpd = str_replace(array('<','>'), '', $To_qpd);
	}else{
		$To_qpd = null;}}

$pattern = '/\s+To: (.*)/';
$To_matches = Array();
preg_match($pattern, $imap_body, $To_matches);
if($To_matches){
	$To = $To_matches[1];
	$To = str_replace(array('<','>'), '', $To);
}else{
	$To = null;}

if(!$To){
	//To
	$pattern = '/\s+To:(.*)/';
	$To_matches = Array();
	preg_match($pattern, $imap_body, $To_matches);
	if($To_matches){
		$To = $To_matches[1];
		$To = str_replace(array('<','>'), '', $To);
	}else{
		$To = null;}}
