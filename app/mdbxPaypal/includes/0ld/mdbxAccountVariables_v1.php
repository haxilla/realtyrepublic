<?php

$currentAccount   = $checkAgent['accountType'];
$currentRemCreds  = $checkAgent['remCreds'];
$currentExpire    = $checkAgent['expireDate'];
$currentPcreds    = $checkAgent['pCreds'];
$agtFirst         = $checkAgent['agtFirst'];
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
