<?php
Use App\models\distro\remDistroCheck;

//set checkEmails
$checkEmails=$remailEventLog['allAccounts']['mainAccount']
   [$mainAccountID]['emailSaves'];

//set variables
$hasValidEmail=0;
$inDistro=0;
//start Array
$distroCheck=[];
//evaluate records
if(array_key_exists('Valid', $checkEmails)){
   //check distro
   $hasValidEmail=1;
   include('distroListValid.php');}

if(array_key_exists('Invalid', $checkEmails)){
   //check distro
   $hasValidEmail=1;
   include('distroListInvalid.php');}

$checkEmails['Valid']=$distroCheck;
//add to event log
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]
   ['emailSaves']=$checkEmails;

//query for remDistroCheck
$remDistroCheck=remDistroCheck::where('propagent_id','=',"$mainAccountID")
->get();
