<?php

//feedbackID
$feedbackFound=null;
$inReplyToFound=null;
$xAutoreply=null;
$toAndFrom=null;
$xEnvelopeSender=null;
$returnPath=null;

//get part 0 of specific message
$msg_header=imap_fetchbody($mbox,$uid,0,FT_UID);

//feedbackID
$feedbackID = Array();
$pattern = '/Feedback-ID: (.*)/';
//regex match
preg_match($pattern, $imap_body, $feedbackID);
if($feedbackID){
	$feedbackFound=1;}

//inreplyTo
$inReplyTo = Array();
$pattern = '/In-Reply-To:(.*)/';
//regex match
preg_match($pattern, $msg_header, $inReplyTo);
if($inReplyTo){
	$inReplyTo=1;}

//X-Autoreply
$xAutoreply = Array();
$pattern = '/X-Autoreply: (.*)/';
//regex match
preg_match($pattern, $msg_header, $xAutoreply);
if($xAutoreply){
	$xAutoreply=1;}

//X-Envelope-Sender
$xEnvelope = Array();
$pattern = '/X-Envelope-Sender: (.*)/';
//regex match
preg_match($pattern, $msg_header, $xEnvelope);
if($xEnvelope){
	$xEnvelopeSender = $xEnvelope[1];}

//Return-Path
$returnPathFound = Array();
$pattern = '/Return-Path: (.*)/';
//regex match
preg_match($pattern, $msg_header, $returnPathFound);
if($returnPathFound){
	$returnPath = $returnPathFound[1];}
