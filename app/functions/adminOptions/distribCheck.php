<?php
// set $theEmail for use in trialChecks
// (distribution list check)

//set default listName
$listName='none';
include(app_path().'/functions/trialCheckAZ.php');
//if listName is not 'none' its an update record
if($listName!=='none'){
   //return back with id
   $eidx=$theList['eidx'];
   $agtBoard=$theList['agtBoard'];
   $agtCounty=$theList['agtCounty'];
   $agtMlsID=$theList['agtMlsID'];
   $agentID1=$eidx;
   //get model of theList returned
   $appPrefix = 'App';
   $theList=$appPrefix.'\\'.$listName;
   $lastArea=$listName;
   $lastAdd='distrib';
}else{
   $agtBoard=null;
   $agtCounty=null;
   $agtMlsID=null;
   $addDistrib=1;
   $eidx=null;
}
