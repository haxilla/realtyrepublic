<?php
use App\models\core\propagent;
use App\models\core\agtoffice;

//encrypt
$passHash=bcrypt($password);
//update agent/office
propagent::where('id','=',"$agentID")
->update([
   'officeID'        => $officeID,
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtDesigs'       => $agtDesigs,
   'agtEmail'        => $agtEmail,
   'agtMainPhone'    => $agtMainPhone,
   'agtWeb'          => $agtWeb,
   'agtUname'        => $agtUname,
   'password'        => $password,
   'passHash'        => $passHash,
   'accountType'     => $accountType,
   'expireDate'      => $expireDate,
   'remCreds'        => $remCreds,
   'pCreds'          => $pCreds,
   'agtReview'       => $agtReview,
   'eidx'            => $eidx,
   'agtBoard'        => $agtBoard,
   'agtCounty'       => $agtCounty,
   'agtMlsID'        => $agtMlsID,
]);
agtoffice::where('propagent_id','=',"$agentID")
->update([
   'officeID'         => $officeID,
   'officeName'       => $officeName,
   'officeAddress1'   => $officeAddress,
   'officeCity'       => $officeCity,
   'officeState'      => $officeState,
   'officeZip'        => $officeZip,
   'propagent_id'     => $agentID,
]);

$accountID=$agentID;
$hasAccount=1;
//if in distro update with propagent_id

if($eidx){
   $appPrefix = 'App\models\distro';
   $theList=$appPrefix.'\\'.$areaList;

   $theList::where('eidx','=',"$eidx")
   ->update([
      'propagent_id'=>$accountID,
   ]);
}
