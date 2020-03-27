<?php

// script assigns tempOfficeID from agtOffices
// into maindata.emailagents on RealtyEmails.com
// this script not currently linkable on any menu

//get null tempOfficeID;
$updateThese=oldAgent::select('umid')
->whereNull('tempOfficeID')
->get();

foreach($updateThese as $the){
   //set umid
   $umid=$the->umid;
   //get tempOfficeID
   $tempOfficeID=agtoffice::where('propagent_id','=',"$umid")
   ->pluck('tempOfficeID')
   ->first();
   //update
   oldAgent::where('umid','=',"$umid")
   ->update([
      'tempOfficeID'=>"$tempOfficeID",
   ]);
}
