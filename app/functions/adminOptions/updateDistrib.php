<?php
$appPrefix = 'App';
$theList=$appPrefix.'\\'.$areaList;
//update
$theList::where('eidx','=',"$eidx")
->update([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtMainPhone'    => $agtMainPhone,
   'agtWeb'          => $agtWeb,
   'agtEmail'        => $agtEmail,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'propagent_id'    => $accountID,
   'agtMlsID'        => $agtMlsID,
]);


if(!$agtBoard){
   //determine board
   $getAgent=$theList::select('agtBoard','agtCounty')
   ->where('eidx','=',"$eidx")
   ->first();
   //set variables
   $agtBoard=$getAgent['agtBoard'];
   $agtCounty=$getAgent['agtCounty'];
}

