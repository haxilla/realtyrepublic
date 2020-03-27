<?php

//regex to find emails
$pattern='/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';

//setup 5 searches
$emailsFound1=array();
$emailsFound2=array();
$emailsFound3=array();
$emailsFound4=array();
$emailsFound5=array();

//only the[0] portion of returned array
//will be exact match

//replace \r\n to avoid broken emails when searching string
$imap_body=str_replace("=\r\n",'',$imap_body);
$imap_fetchbody=str_replace("=\r\n",'',$imap_fetchbody);
$body_header=str_replace("=\r\n",'',$body_header);
$plainmsg=str_replace("=\r\n",'',$plainmsg);
$htmlmsg=str_replace("=\r\n",'',$htmlmsg);


//imap_body
preg_match_all($pattern, $imap_body, $emailsFound1);
	if($emailsFound1){
		$emailsFound1=$emailsFound1[0];}
//imap_fetchbody
preg_match_all($pattern, $imap_fetchbody, $emailsFound2);
	if($emailsFound2){
		$emailsFound2=$emailsFound2[0];}
//body_header
preg_match_all($pattern, $body_header, $emailsFound3);
	if($emailsFound3){
		$emailsFound3=$emailsFound3[0];}
//plainmsg
preg_match_all($pattern, $plainmsg, $emailsFound4);
	if($emailsFound4){
		$emailsFound4=$emailsFound4[0];}
//htmlmsg
preg_match_all($pattern, $htmlmsg, $emailsFound5);
	if($emailsFound5){
		$emailsFound5=$emailsFound5[0];}

//default var
$emailsFound=array();

//merge arrays with values
if($emailsFound1){
	$emailsFound=array_merge($emailsFound,$emailsFound1);}
if($emailsFound2){
	$emailsFound=array_merge($emailsFound,$emailsFound2);}
if($emailsFound3){
	$emailsFound=array_merge($emailsFound,$emailsFound3);}
if($emailsFound4){
	$emailsFound=array_merge($emailsFound,$emailsFound4);}
if($emailsFound5){
	$emailsFound=array_merge($emailsFound,$emailsFound5);}

//function to strip dups regardless of case
include(app_path().'/functions/arrays/unique_array_ci.php');


$emailsFound=array_iunique($emailsFound);

$emailsFoundArray=array();

foreach($emailsFound as $thisEmail){

	$checkEmail=$thisEmail;
	include(app_path().'/bounces/check/theMsgID_check.php');

	$emailsFoundArray[]=[
		'thisLoop'  		=> 'emailsFoundArray',
		'thisEmail'			=> $thisEmail,
		'theMsgID'			=> $theMsgID,
		'eidx'				=> NULL,
		'fullName'			=> NULL,
		'firstName'			=> NULL,
		'middleName'		=> NULL,
		'lastName'			=> NULL,
		'uid'				=> $uid,
		'subject'			=> $subject,
		'msgDate'			=> $msgDate,
		'adreCount'			=> NULL,
		'agentLicNum'		=> NULL,
		'employerLicNum'	=> NULL,
		'umid'				=> NULL,
		'umidCount'			=> NULL,
	];

}

//unique values
//$emailsFound=array_unique($emailsFound);

//dd($emailsFound,$imap_header,);
//dd($emailsFound1,$emailsFound2,$emailsFound3,$emailsFound4,$emailsFound5);