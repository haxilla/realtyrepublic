<?php

use App\propagent;
use App\agtoffice;
use App\masterVersion;

if(!$password){
   $password=str_random(10);}

$passHash=bcrypt($password);
//set current microVersion
$getVersion=masterVersion::orderBy('id','desc')
->first();
$microVersion=$getVersion['microVersion'];
//add agent
$new=propagent::create([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtFullName'     => $agtFirst.' '.$agtLast,
   'agtDesigs'       => $agtDesigs,
   'agtMainPhone'    => $agtMainPhone,
   'agtWeb'          => $agtWeb,
   'agtEmail'        => $agtEmail,
   'agtUname'        => $agtUname,
   'password'        => $password,
   'passHash'        => $passHash,
   'accountType'     => $accountType,
   'officeID'        => $officeID,
   'agtBoard'        => $agtBoard,
   'agtCounty'       => $agtCounty,
   'agtMlsID'        => $agtMlsID,
   'startDate'       => \Carbon\Carbon::now(),
   'IP'              => Request::ip(),
   'eidx'            => $eidx,
   'microVersion'    => $microVersion,]);

//get new agentID
$agentID=$new->id;

//add office
agtoffice::create([
   'officeName'      => $officeName,
   'officeID'        => $officeID,
   'officeAddress1'  => $officeAddress,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'propagent_id'    => $agentID,]);

//set to 0 since its added now
$addAccount=0;
$accountID=$agentID;
$hasAccount=1;

if($eidx){
   $appPrefix = 'App';
   $theList=$appPrefix.'\\'.$areaList;

   $theList::where('eidx','=',"$eidx")
   ->update([
      'propagent_id'=>$accountID,
   ]);
}
