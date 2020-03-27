<?php
// set $theEmail for use in trialChecks
// (distribution list check)

//set default listName
$listName='none';
include(app_path().'/functions/trialCheckAZ.php');
//if listName is not 'none' its an update record
if($listName!=='none'){
   //update
   $eidx=$theList['eidx'];
   //get model by $areaList set in form
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
      'officeAddress1'   => $officeAddress,
      'officeCity'      => $officeCity,
      'officeState'     => $officeState,
      'officeZip'       => $officeZip,
   ]);
   //return with agentID
   $agentID=$eidx;
}else{
   //create - get model by $areaList set in form
   $appPrefix = 'App';
   $theList=$appPrefix.'\\'.$areaList;
   //add to distribution list
   $new=$theList::create([
      'agtEmail'           => $theEmail,
      'agtFirst'           => $agtFirst,
      'agtLast'            => $agtLast,
      'officeName'         => $officeName,
      'officeAddress1'     => $officeAddress,
      'officeCity'         => $officeCity,
      'officeState'        => $officeState,
      'officeZip'          => $officeZip,
      'agtMainPhone'       => $agtMainPhone,]);
   //return with agentID
   $agentID=$new->id;
}
