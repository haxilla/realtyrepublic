<?php

//final recipient
if($finalRecipient){

	$thisEmail=$finalRecipient;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'finalRecipient'=>$finalRecipient,
		'uid'			=>$uid,
	];}

//original recipient
if($originalRecipient){

	$thisEmail=$originalRecipient;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'originalRecipient'	=> $originalRecipient,
		'uid'				=> $uid,];}

//original recipient
if($deliverTo){

	$thisEmail=$deliverTo;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'deliverTo'		=> $deliverTo,
		'uid'			=> $uid,];}

//original recipient
if($resentTo){

	$thisEmail=$resentTo;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'resentTo'		=> $resentTo,
		'uid'			=> $uid,];}

//original recipient
if($To){

	$thisEmail=$To;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'To'	=> $To,
		'uid'	=> $uid,];}

//original recipient
//qpd=quoteable printed decode
//some imap_body does not parse
//this catches
if($To_qpd){

	$thisEmail=$To_qpd;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'To_qpd' => $To_qpd,
		'uid'	 => $uid,];}

//original recipient
if($resentFrom){

	$thisEmail=$resentFrom;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'resentFrom'	=> $resentFrom,
		'uid'			=> $uid,];}

//original recipient
if($earthlink){

	$thisEmail=$earthlink;
	include('findDistro.php');

	$emailCount++;
	$emailFound[]=[
		'earthlink'		=> $earthlink,
		'uid'			=> $uid,];}