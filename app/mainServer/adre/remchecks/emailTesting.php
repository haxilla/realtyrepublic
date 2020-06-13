<?php
//add to log if present

if($emailSaves){
   $remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['emailSaves']=$emailSaves;}

//test emails
//separate by spaces
$emailTest=[];
$validEmail=0;
$emailMultiples=0;

if(strpos($emailSaves,'||')){
   //setup for each email
   $emailMultiples=1;
   $emailMultipleList = explode("||", $emailSaves);
   foreach($emailMultipleList as $the){
      include(app_path().'/adre/functions/emailValidateDomainMulti.php');}

}elseif(strpos($emailSaves,'@')){
   include(app_path().'/adre/functions/emailValidateDomain.php');}

//attach results to array
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['emailSaves']=$emailTest;

//if($validEmail && $multipleAccounts==1){
//   dd('doublecheck valid email!');}
