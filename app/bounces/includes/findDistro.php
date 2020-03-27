<?php

Use App\models\oldEmails\aznaz;
Use App\models\oldEmails\azsaz;
Use App\models\oldEmails\azphxmetro;
Use App\models\oldEmails\azphxne;
Use App\models\oldEmails\azphxse;
Use App\models\oldEmails\azphxwv;

if(!$thisEmail){
	dd('error-line11-bounces/includes/findDistro.php');}

$thisEmail=str_replace("\r","",$thisEmail);

//scan lists
$aznaz=aznaz::where('email','=',$thisEmail)
->first();
$azsaz=azsaz::where('email','=',$thisEmail)
->first();
$azphxmetro=azphxmetro::where('email','=',$thisEmail)
->first();
$azphxne=azphxne::where('email','=',$thisEmail)
->first();
$azphxse=azphxse::where('email','=',$thisEmail)
->first();
$azphxwv=azphxwv::where('email','=',$thisEmail)
->first();

//create arrays
if($aznaz){
	
	$distroCount++;
	$firstName=$aznaz['FirstName'];
	$middleName=$aznaz['middleName'];
	$lastName=$aznaz['LastName'];
	$fullName=$aznaz['FullName'];
	$eidx=$aznaz['eidx'];
	$theModel='aznaz';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'msgDate'	=>$the->date,
		'list'		=>'aznaz',
		'eidx'		=>$eidx,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,
	];}

if($azsaz){
	
	$distroCount++;
	$firstName=$azsaz['FirstName'];
	$middleName=$azsaz['middleName'];
	$lastName=$azsaz['LastName'];
	$fullName=$azsaz['FullName'];
	$eidx=$azsaz['eidx'];
	$theModel='azsaz';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'msgDate'	=>$the->date,
		'list'		=>'azsaz',
		'eidx'		=>$eidx,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,
	];}

if($azphxmetro){
	
	$distroCount++;
	$firstName=$azphxmetro['FirstName'];
	$middleName=$azphxmetro['middleName'];
	$lastName=$azphxmetro['LastName'];
	$fullName=$azphxmetro['FullName'];
	$eidx=$azphxmetro['eidx'];
	$theModel='azphxmetro';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'list'		=>'azphxmetro',
		'eidx'		=>$eidx,
		'msgDate'	=>$the->date,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,

	];}


if($azphxne){
	
	$distroCount++;
	$firstName=$azphxne['FirstName'];
	$middleName=$azphxne['middleName'];
	$lastName=$azphxne['LastName'];
	$fullName=$azphxne['FullName'];
	$eidx=$azphxne['eidx'];
	$theModel='azphxne';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'msgDate'	=>$the->date,
		'list'		=>'azphxne',
		'eidx'		=>$eidx,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,
	];}

if($azphxse){
	
	$distroCount++;
	$firstName=$azphxse['FirstName'];
	$middleName=$azphxse['middleName'];
	$lastName=$azphxse['LastName'];
	$fullName=$azphxse['FullName'];
	$eidx=$azphxse['eidx'];
	$theModel='azphxse';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'msgDate'	=>$the->date,
		'list'		=>'azphxse',
		'eidx'		=>$eidx,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,
	];}

if($azphxwv){
	
	$distroCount++;
	$firstName=$azphxwv['FirstName'];
	$middleName=$azphxwv['middleName'];
	$lastName=$azphxwv['LastName'];
	$fullName=$azphxwv['FullName'];
	$eidx=$azphxwv['eidx'];
	$theModel='azphxwv';

	include('nameParts.php');	

	$distroFound[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'msgDate'	=>$the->date,
		'list'		=>'azphxwv',
		'eidx'		=>$eidx,
		'email'		=>$thisEmail,
		'firstName'	=>$firstName,
		'middleName'=>$middleName,
		'lastName'	=>$lastName,
		'fullName'	=>$fullName,
		'diagnostic'=>$diagnostic,
	];}

if(!$distroCount){
	$noDistro[]=[
		'msg'		=>$msg,
		'uid'		=>$uid,
		'thisEmail'	=>$thisEmail,
	];}