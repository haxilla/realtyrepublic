<?php

if(isset($the->to)
&&isset($the->from)){
	$toAndFrom=1;
	$to=$the->to;
	$from=$the->from;}

if(!isset($the->to)){
	//mark for delete
	$to=null;
	imap_delete($mbox,$uid,FT_UID);
	//build array
	$noTo[]=[
		'uid'=>$uid,
		'thisSubject'=>$thisSubject,
	];}

if(!isset($the->from)){
	//mark for delete
	$from=null;
	imap_delete($mbox,$uid,FT_UID);
	//build arry
	$noFrom[]=[
		'uid'=>$uid,
		'thisSubject'=>$thisSubject,
	];}