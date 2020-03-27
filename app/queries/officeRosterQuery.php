<?php
use App\models\core\agtoffice;

//get officeID
$officeID=request('officeID');
//count clicks
$clickCount=request('clickCount');
//error if none
if(!$officeID){
   dd('error-line33-officeRosterController');}

$officeFlagQuery=agtoffice::where('tempofficeID','=',"$officeID")
->select('tempOfficeID','propagent_id','officeName','officeAddress1',
  'officeCity','officeState','officeZip','armlsOfficeID')
->with(['theAgent'=>function($q){
   $q->select('id','agtFullName','startDate','remCreds',
    'accountType','officeID');
}])
->orderBy('updated_at','desc')
->get();

//map fields
$officeFlagMap = $officeFlagQuery->map(function ($item) {
  return [
      'tempOfficeID'    => $item->tempOfficeID,
      'propagent_id'    => $item->propagent_id,
      'officeName'      => $item->officeName,
      'officeAddress1'  => $item->officeAddress1,
      'officeCity'      => $item->officeCity,
      'officeState'     => $item->officeState,
      'officeZip'       => $item->officeZip,
      'armlsOfficeID'   => $item->armlsOfficeID,
      //theAgent
      'theAgent'        => $item->theAgent
      ->map(function ($inner){
         return [
           'agtFullName'  => $inner->agtFullName,
           'propagent_id' => $inner->id,
           'startDate'    => $inner->startDate,
           'remCreds'     => $inner->remCreds,
           'accountType'  => $inner->accountType,
           'officeID'     => $inner->officeID
          ];
      })
   ];
});
//groupBy tempOfficeID
$officeRosterQuery=$officeFlagMap->groupBy('xOfficeID');
