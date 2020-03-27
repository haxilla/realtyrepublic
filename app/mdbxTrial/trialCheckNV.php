<?php

use App\models\rets\glvarAgent;
//case insenstive search
$theEmail=strtolower($theEmail);
//if none search
if($listName=='none'){
	// check data - case insensitive search
	$theList=glvarAgent::whereRaw('LOWER(Email) = ?', $theEmail)
	->first();
	//set listName if found
	if($theList){
		$listName='glvar';}}
