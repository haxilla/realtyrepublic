<?php
Use App\models\admin\newaccessrequest;

$dup=newaccessrequest::where('agtEmail','=',"$agtEmail")
->first();
$record='new';
if($dup){
   $record='update';
   newaccessrequest::where('agtEmail','=',"$agtEmail")
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
}else{
   // $amt - credits wanted
   // but not on distro list
   $newID=newaccessrequest::create([
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
      'theIP'           => \Request::ip(),
      'key'             => $shortKey,
      'amt'             => $purchaseAmt,
      'purchaseDesc'    => $purchaseDesc,
   ]);
}


