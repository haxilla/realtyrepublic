<?php
use App\masterVersion;

$getVersion=masterVersion::orderBy('id','desc')
->first();
$microVersion=$getVersion['microVersion'];

$newID=propagent::create([
   'eidx'         => $theList['eidx'],
   'agtAddress1'  => $theList['agtAddress1'],
   'agtAddress2'  => $theList['agtAddress2'],
   'agtType'      => $theList['agtType'],
   'agtCity'      => $theList['agtCity'],
   'agtFirst'     => $agtFirst,
   'agtLast'      => $theList['agtLast'],
   'agtEmail'     => $theList['agtEmail'],
   'agtFullName'  => $theList['agtFullName'],
   'agtHomePhone' => $theList['agtHomePhone'],
   'agtEmail'     => $theList['agtEmail'],
   'agtMainPhone' => $theList['agtMainPhone'],
   'agtMobile'    => $theList['agtMobile'],
   'officeID'     => $theList['officeID'],
   'agtZip'       => $theList['agtZip'],
   'agtCounty'    => $theList['agtCounty'],
   'agtBoard'     => $theList['agtBoard'],
   'agtWeb'       => $theList['agtWeb'],
   'agtState'     => $theList['agtState'],
   'trialDate'    => \Carbon\Carbon::now(),
   'startDate'    => \Carbon\Carbon::now(),
   'agtUname'     => $theEmail,
   'trialPswd'    => $agtPswd,
   'passhash'     => bcrypt($agtPswd),
   'accountType'  => 1,
   'agtReview'    => 1,
   'microVersion' => $microVersion,]);

//get new new propagent_id
$umid=$newID->id;

if($theList && ($theList['officeAddress2'] !== 'NULL')){
   $officeAddress=$theList['officeAddress1'].' '.$theList['officeAddress2'];
}else{
   $officeAddress=$theList['officeAddress1'];
}

agtoffice::create([
   'propagent_id'    => $umid,
   'officeID'        => $theList['officeID'],
   'officeName'      => $theList['officeName'],
   'officeAddress1'  => $officeAddress,
   'officeCity'      => $theList['officeCity'],
   'officeState'     => $theList['officeState'],
   'officeZip'       => $theList['officeZip'],
   'officeBroker'    => $theList['officeBroker'],
   'officePhone'     => $theList['officePhone'],
   'eidx'            => $theList['eidx'],
]);

$appPrefix = 'app';
$theList=$appPrefix.'\\'.$listName;

$theList::where('agtEmail','=',"$theEmail")
->update([
   'propagent_id'=>$umid
]);
