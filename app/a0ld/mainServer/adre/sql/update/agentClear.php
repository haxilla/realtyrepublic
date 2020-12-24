<?php
Use App\models\core\agtoffice;
Use App\models\admin\agentNote;
Use App\models\oldsite\oldAgent;
Use App\models\core\propagentcleanup;
//set now
$now=Carbon\Carbon::now();
//update agent
agtoffice::where('propagent_id','=',"$mainAccountID")
->update([
   'agentClear'=>$now,
]);
//update office
agtoffice::where('tempOfficeID','=',"$mainTempOfficeID")
->update([
   'officeClear'=>$now,
]);
//update realtyEmails
oldAgent::where('umid','=',"$mainAccountID")
->update([
   'agentClear'=> $now,
   'xOfficeID' => $EmployerLicNumber,
]);
//add to agentNotes if any
if(array_key_exists('agentNote', $remailEventLog)){
   //loop
   foreach($remailEventLog['agentNote'] as $the){
      //create record
      agentNote::create([
         'propagent_id' => $mainAccountID,
         'theNote'      => $the,
         'LicNumber'    => $LicNumber,]);}}

//mark as main if not a delete record
if(!$deleteThis){
   //propagentcleanup
   propagentcleanup::where('propagent_id','=',"$mainAccountID")
   ->update([
      'accountType'              => 'main',
      'LicNumber'                => $LicNumber,
      'EmployerLicNumber'        => $EmployerLicNumber,
      'EmployerLicNumberCheck'   => \Carbon\Carbon::now(),
      'LicNumberCheck'           => \Carbon\Carbon::now(),
   ]);}

