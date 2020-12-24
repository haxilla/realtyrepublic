<?php
//model
use App\models\core\agtoffice;
use App\models\core\propoffice;
use App\models\core\propagent;
//start log
$officePeerLog=[];
//agtOffice

$agtOfficePeerQuery=agtoffice::select('propagent_id','agentClear')
->where('tempOfficeID','=',"$mainTempOfficeID");
//allCount
$agtOfficeAllCount=$agtOfficePeerQuery->count();

//clear
$agtOfficeClear=agtoffice::whereNotNull('agentClear')
   ->where('tempOfficeID','=',"$mainTempOfficeID")
   ->where('agentConfirmDelete','=','0')
   ->whereHas('theAgentCleanup',function($q){
      $q->where('accountType','=','main');
   });
   //clearCount
   $agtOfficeClearCount=$agtOfficeClear->count();
//check
$agtOfficeCheck=agtoffice::whereNull('agentClear')
   ->where('tempOfficeID','=',"$mainTempOfficeID")
   ->where('agentConfirmDelete','=','0')
   ->whereHas('theAgentCleanup',function($q){
      $q->whereNull('accountType');
   });
   //checkCount
   $agtOfficeCheckCount=$agtOfficeCheck->count();
//propoffice

$propoffice=propoffice::where('officeID','=',"$mainTempOfficeID");
//propfficeStats
$propOfficeStats=$propoffice->select('EmployerLicNumber',
   'armlsOfficeID','officeID','officeClear','DesignatedBrokerLicNumber')
->first();

//used for nextRecord Value
$clearByLogin=propagent::whereNotNull('agtFullName')
->select('id','lastLogin','agtFullName')
->with(['theAgtOffice'=>function($q){
   $q->select('propagent_id');
}])
->whereHas('theAgtOffice',function($q){
   $q->whereNull('agentClear');
})
->whereHas('theAgentCleanup',function($q){
   $q->whereNull('accountType');
})
->orderBy('lastLogin','desc')
->first();

//set vars
$checkELN         = $propOfficeStats['EmployerLicNumber'];
$checkDBLN        = $propOfficeStats['DesignatedBrokerLicNumber'];
$propOfficeClear  = $propOfficeStats['officeClear'];
$propOfficeID     = $propOfficeStats['officeID'];
$armlsOfficeID    = $propOfficeStats['armlsOfficeID'];
//check officeClear
if($checkELN && $checkDBLN && $propOfficeClear){
   $propOfficeClear=1;}

//log results
if($propOfficeClear && ($agtOfficeCheckCount > 0 || $agtOfficeClearCount>0)){
   //log
   $officePeerLog['propoffice']['officeID']=$propOfficeID;
   $officePeerLog['propoffice']['EmployerLicNumber']=$checkELN;
   $officePeerLog['propoffice']['armlsOfficeID']=$armlsOfficeID;
   $officePeerLog['propoffice']['DesignatedBrokerLicNumber']=$checkDBLN;
   $officePeerLog['propoffice']['propOfficeClear']=$propOfficeClear;
   $officePeerLog['agtoffice']['tempOfficeID']=$mainTempOfficeID;
   $officePeerLog['agtoffice']['basedOnAccount']=$mainAccountID;
   $officePeerLog['agtoffice']['allCount']=$agtOfficeAllCount;
   $officePeerLog['agtoffice']['clearCount']=$agtOfficeClearCount;
   $officePeerLog['agtoffice']['checkCount']=$agtOfficeCheckCount;
   //add 5 records to response
   $agtOfficePeerQuery=$agtOfficePeerQuery->whereNull('agentClear')
   ->with(['theAgent'=>function($q){
      $q->select('agtFullName','id','lastLogin',
         'startDate','accountType');}])
   ->take(5)
   ->get();
   //set next 5 loop for offices
   if($agtOfficePeerQuery->count()>0){

      foreach($agtOfficePeerQuery as $the){

         foreach($the['theAgent'] as $t){
            //set variables
            $theID=$t['id'];
            $agtFullName=$t['agtFullName'];
            $lastLogin=$t['lastLogin'];
            $startDate=$t['startDate'];
            $accountType=$t['accountType'];
            //add array
            $officePeerLog['recordStart'][]=[
               'propagent_id' => $theID,
               'agtFullName'  => $agtFullName,
               'lastLogin'    => $lastLogin,
               'startDate'    => $startDate,
               'accountType'  => $accountType,
            ];}}

      $remailEventLog['officePeers']=$officePeerLog;
      $remailEventLog['nextRecord']['byOffice']=$theID;}

   $remailEventLog['nextRecord']['byLogin']=$clearByLogin['id'];

}else{

   $remailEventLog['nextRecord']['byLogin']=$clearByLogin['id'];

   //NOT IN PROP OFFICE YET
   //remove this from propoffice
   //dd('deletefrompropoffice');
}

