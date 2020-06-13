<?php

$to=null;
if(isset($the->to)){
	$to=$the->to;}

$from=null;
if(isset($the->from)){
	$from=$the->from;}

if(stripos($thisSubject, 'RE:')!==false){
	//RE: found in subject
	$hasRE[]=[
		'to'			=>$to,
		'from'			=>$from,
		'uid'			=>$uid,
		'thisSubject'	=>$thisSubject,
	];

}else{
	//RE: NOT found
	$noRE[]=[
		'to'			=>$to,
		'from'			=>$from,
		'uid'			=>$uid,
		'thisSubject'	=>$thisSubject,
	];
}