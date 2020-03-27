<?php

//defaults
$firstName=null;
$middleName=null;
$lastName=null;

//get thisFirst & thisLast
//by splitting string on spaces
$nameParts 		= preg_split('/\s+/', $fullName);
$namepartCount	= count($nameParts);

if($namepartCount==3){
	$firstName=$nameParts[0];
	$middleName=$nameParts[1];
	$lastName=$nameParts[2];

}elseif($namepartCount==2){
	$firstName=$nameParts[0];
	$lastName=$nameParts[1];}

//if first & last found
if($firstName && $lastName){
	//create array
	$nameArray_found[]=[
		'fullName'		=>$fullName,
		'firstName'		=>$firstName,
		'middleName'	=>$middleName,
		'lastName'		=>$lastName,];
}else{
	$nameArray_error[]=[
		'fullName'	=> $fullName,
	];}