<?php

$checkAgent=propagent::where('id','=',"$umid")
->first();

if(!$checkAgent){
    //send error message to admin
    $data=[
    'errorMessage'=>'error with UMID
    - check line 128 mdbxIPNsimple',];

    $theSubject='Error with UMID';
    include('paypalAdminError.php');
}

include('mdbxPaypalItems.php');

//past all checks set variables
$currentAccount   = $checkAgent['accountType'];
$currentRemCreds  = $checkAgent['remCreds'];
$currentExpire    = $checkAgent['expireDate'];
$currentPcreds    = $checkAgent['pCreds'];
$now              = \Carbon\Carbon::now();

//if its less than now add 6 months to now
if($currentExpire && $currentExpire < $now){
  $newExpireDate=\Carbon\Carbon::now()->addMonths(6);
}elseif($currentExpire){
  $newExpireDate=$currentExpire->addDays(180);
}else{
  $newExpireDate=\Carbon\Carbon::now()->addMonths(6);}

$updateRemCreds   = $currentRemCreds+$addCredit;
$updatePcreds     = $currentPcreds+$addCredit;
