<?php
Use App\models\admin\newaccessrequest;

$check=newaccessrequest::where('key','=',$shortKey)
->first();

if(!$check){
   dd('error-line8-app/functions/inputHelper/trialInfoEdit');}

newaccessrequest::where('key','=',"$shortKey")
->update([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtEmail'        => $agtEmail,
   'agtMainPhone'    => $agtMainPhone,
   'agtWebsite'      => $agtWebsite,
   'agtDesigs'       => $agtDesigs,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'key'             => $shortKey,
   'amt'             => $purchaseAmt,
   'purchaseDesc'    => $purchaseDesc,
]);



