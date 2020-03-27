<?php

if(!isset($the->to)){
	//mark for delete
	imap_delete($mbox,$uid,FT_UID);
	//build array
	$noTo[]=[
		'uid'=>$uid,
		'thisSubject'=>$thisSubject,
	];}

if(!isset($the->from)){
	//mark for delete
	imap_delete($mbox,$uid,FT_UID);
	//build arry
	$noFrom[]=[
		'uid'=>$uid,
		'thisSubject'=>$thisSubject,
	];}