<?php

//get officeID
$officeID=request('officeID');
//count clicks
$clickCount=request('clickCount');
//error if none
if(!$officeID){
   dd('error-line33-officeRosterController');}

$officeFlagQuery=agtoffice::where('tempofficeID','=',"$officeID")
->select('tempOfficeID','propagent_id','officeName','officeCity',
   'tempOfficeID')
->with(['theAgent'=>function($q){
   $q->select('agtFullName','id');
}])
->get();
//map fields
$officeFlagMap = $officeFlagQuery->map(function ($item) {
  return [
      'propagent_id' => $item->propagent_id,
      'tempOfficeID' => $item->tempOfficeID,
      'theAgent'     => $item->theAgent
      ->map(function ($inner){
         return [
           'agtFullName'   => $inner->agtFullName,
           'propagent_id'  => $inner->id,
          ];
      })
   ];
});
//groupBy tempOfficeID
$officeFlag=$officeFlagMap->groupBy('xOfficeID');
//test Loop - can send results to page now
foreach($officeFlag as $the){
   foreach($the as $t){
      //set officeID
      $tempOfficeID=$the[0]['tempOfficeID'];
      //update propoffice
      propoffice::where('officeID','=',"$tempOfficeID")
         ->update([
         'officeFlag'=>1,
      ]);
      //agtOffice
      agtOffice::where('tempOfficeID','=',"$tempOfficeID")
         ->update([
         'officeFlag'=>1,
      ]);
      //below is the way to show ONE office record
      //echo $the[0]['tempOfficeID'].'<BR><BR>';
      //echo $the[0]['propagent_id'].'<BR><BR>';
      foreach ($t['theAgent'] as $key){
         //dd($key)
         //get umid
         $umid=$key['propagent_id'];
         //update local
         agtoffice::where('propagent_id','=',"$umid")
         ->update([
            'agentFlag'=>1,
         ]);
         //oldAgent
         oldAgent::where('umid','=',"$umid")
         ->update([
            'agentFlag'    =>1,
            'tempOfficeID' =>$tempOfficeID,
         ]);
      };
   };
};

//after 5 clicks refresh page
$clickCount++;
//output json
$idArray = array(
   'status'       => 'success',
   'officeID'     => $officeID,
   'clickCount'   => $clickCount
);
//display & exit
echo json_encode($idArray);
exit();
