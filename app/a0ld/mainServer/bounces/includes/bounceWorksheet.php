<?php

Use App\bounces\models\bounceWorksheet;

//query 
$check=bounceWorksheet::where('email','=',$the['email'])
->first();

//defaults
$eidx=$check['eidx'];
$distroFound=0;
//change if found
if($eidx){
	$distroFound=1;}

//if
if($check){

	//update bounceCount if dup
	$bounceCount=$check['bounceCount']+1;
	$checkDate=\Carbon\Carbon::now();
	bounceWorksheet::where('email','=',$the['email'])
	->update([
		'bounceCount'	=>$bounceCount,
		'checkDate'		=>$checkDate,
		'msgDate'		=>$the['msgDate']]);

}else{

	// add to database
	// no dups
	bounceWorksheet::create([
		'list'			=>$the['list'],
		'email'			=>$the['email'],
		'eidx'			=>$the['eidx'],
		'distroFound'	=>$distroFound,
		'firstName'		=>$the['firstName'],
		'middleName'	=>$the['middleName'],
		'lastName'		=>$the['lastName'],
		'fullName'		=>$the['fullName'],
		'msgDate'		=>$the['msgDate'],
		'checkDate'		=>\Carbon\Carbon::now(),
		'diagnostic'	=>$the['diagnostic'],]);}