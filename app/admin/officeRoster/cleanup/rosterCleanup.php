<?php
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\core\propoffice;
use App\models\oldsite\oldAgent;
// if       agentFlag=0          //(agtOffice)
// and      startDate is null    //(propagent)
$flagAgent=propagent::select('id','startDate','agtFullName',
   'remCreds','officeID')
->where(function($q){
   $q->whereNull('officeID')
      ->orWhereNull('startDate')
      ->orWhereNull('xxAgtUname');
})
//or where officeID=null and agentflag=0
->with(['theAgtOffice'=>function($q){
   $q->select('propagent_id','agentFlag');
}])
->whereHas('theAgtOffice')
->whereDoesntHave('theAgtOffice',function($q){
   $q->where('agentFlag','=','1');
})
->get();

//flag records with blank office names
$flagOffice=agtOffice::where('agentFlag','=','0')
->where(function($q){
   $q ->whereNull('officeName')
      ->orWhereNull('tempOfficeID')
      ->orWhereNull('officeAddress1');
})
->get();

foreach($flagOffice as $the){
   agtOffice::where('propagent_id','=',"$the->propagent_id")
   ->update([
      'agentFlag'    => 1,
      'officeFlag'   => 1,
   ]);
}

//run loop to set flag on NO startDates
//that arent already flagged
foreach($flagAgent as $the){
   agtoffice::where('propagent_id','=',"$the->id")
   ->update([
      'agentFlag'=>1,
   ]);

   /* Turn on later
   oldAgent::where('umid','=',"$the->id")
   ->update([
      'agentFlag'=>1,
   ]);
   */
}

