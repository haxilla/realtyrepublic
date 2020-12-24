<?php

$autoreplies=array('Automatic reply','Out of Office',
	'Auto-Reply','I am on vacation','Out of Country',
    'time with my family','Out of the office');

$subject='dontmatchanything';
if(isset($the->subject)){
	$subject = $the->subject;}

$found=null;

foreach ($autoreplies as $keyword) {
    //if (strstr($string, $url)) {
    if (stripos($subject, $keyword) !== FALSE){
    	$found=1;
    	imap_delete($mbox, $uid, FT_UID);
    	$autoreplyFound[]=[
    		'keyword'	=> $keyword,
    		'subject'	=> $subject,
    		'uid'		=> $uid,
    	];
    };
};

if(!$found){
	$autoreplyNone[]=[
		'subject'	=> $subject,
		'uid'		=> $uid,
	];
}