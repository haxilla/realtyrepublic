<?php

//   **   YOU ARE IN A LOOP    **  //
//   **   CURRENT VARIABLE     **  //
//   **      $thisDup          **  //
//   ****************************  //
//   ****************************  //

//models
Use App\models\core\propagent;
Use App\models\core\agtoffice;
Use App\models\core\propflyer;
//queries
$getAgent=propagent::select('id','remCreds','startDate',
   'expireDate','accountType','agtPhoto','agtLogo','xxAgtUname',
   'agtEmail','agtFullName','accountType','lastLogin','officeID',
   'pCreds')
->where('id','=',"$thisDup")
->first();
//office
$getOffice=agtoffice::where('propagent_id','=',"$thisDup")
->select('propagent_id','remailAgentID','tempOfficeID','newRemID')
->first();
//flyers
$getFlyers=propflyer::where('propagent_id','=',"$thisDup")
->select('id')
->get();

//count
$thisFlyerCount=$getFlyers->count();

//main variables//
$thisID              = $getAgent['id'];
$hasAgtPhoto         = 0;
$hasAgtLogo          = 0;
$agtPhotoDownload    = 0;
$agtLogoDownload     = 0;
$newRemID            = $newRemID;
$thisRemailAgentID   = $getOffice['remailAgentID'];
$thisOfficeID        = $getAgent['officeID'];
$thisTempOfficeID    = $getOffice['tempOfficeID'];
$thisAccountType     = $getAgent['AccountType'];
$thisRemCreds        = $getAgent['remCreds'];
$thisPcreds          = $getAgent['pCreds'];
$thisFlyerCount      = $thisFlyerCount;
$agtPhotoCheck       = 0;
$agtLogoCheck        = 0;
$imagesOK            = 0;
//thisAccountStatus variables
$hasFlyers           = 0;
$moveFlyers          = 0;
$neverActive         = 0;
$wasActive           = 0;
$isDormant           = 0;
$isActive            = 0;
$hasCredits          = 0;
$hasTime             = 0;
// ** if there USE - otherwise zero out ** //
$thisAccountType     = $getAgent['accountType'];
   if(!$thisAccountType){
   $thisAccountType  = 0;}
$thisLastLogin       = $getAgent['lastLogin'];
   if(!$thisLastLogin){
   $thisLastLogin    = 0;}
$thisStartDate       = $getAgent['startDate'];
   if(!$thisStartDate){
   $thisStartDate    = 0;}
$thisExpireDate      = $getAgent['expireDate'];
   if(!$thisExpireDate){
   $thisExpireDate   = 0;}
$thisRemCreds        = $getAgent['remCreds'];
   if(!$thisRemCreds){
   $thisRemCreds     = 0;}
$thisAgtEmail        = $getAgent['agtEmail'];
   if(!$thisAgtEmail){
   $thisAgtEmail     = 0;}
$thisXxAgtUname      = $getAgent['xxAgtUname'];
   if(!$thisXxAgtUname){
   $thisXxAgtUname   = 0;}
$thisAgtFullName     = $getAgent['agtFullName'];
   if(!$thisAgtFullName){
   $thisAgtFullName  = 0;}
$thisAgtPhoto        = $getAgent['agtPhoto'];
   if(!$thisAgtPhoto){
   $thisAgtPhoto     = 0;}
$thisAgtLogo         = $getAgent['agtLogo'];
   if(!$thisAgtLogo){
   $thisAgtLogo      = 0;}

//setNow
$now=\Carbon\Carbon::now();
//need 2 instances since its being modified
$saveNow=\Carbon\Carbon::now();
//lastYear
$lastYear=$now->subDays(365);
//figure out accountStatus
if($thisAccountType<2){
   //trials and dups
   $neverActive=1;
   $isDormant=1;
}elseif($thisAccountType<5){
   //unlimitedAccount
   $wasActive=1;
   if($thisExpireDate && $thisExpireDate>$saveNow){
      $hasTime=1;}
   if($thisLastLogin &&
   $thisLastLogin>$lastYear){
      $isDormant=1;}
}elseif($thisAccountType=='5'){
   //credit Account
   $wasActive=1;
   if($thisRemCreds>0){
      $hasCredits=1;}
   if($thisLastLogin && $thisLastLogin<$lastYear){
      $isDormant=1;}
}else{
   dd('oddballAccount check it out',$thisDup);}

