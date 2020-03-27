<?php
Use App\models\core\propagentmeta;
Use App\models\core\propagentcleanup;
//merges
$theMerge=propagentmeta::select('propagent_id',
   'mergedWith','LicNumber','EmployerLicNumber','LicStatus',
   'newRemID','newRemOfficeID')
->whereNotNull('mergedWith')
->get();
//main
$theMain=propagentmeta::select('propagent_id',
   'mergedWith','LicNumber','EmployerLicNumber','LicStatus',
   'newRemID','newRemOfficeID')
->whereNull('mergedWith')
->get();
//mergeAccounts
foreach($theMerge as $the){
   //variables
   $mergedWith=$the->mergedWith;
   $thisID=$the->propagent_id;
   //create main record
   $matchThese=array('propagent_id'=>$thisID);
   //sql
   propagentcleanup::firstOrCreate($matchThese,[
      'propagent_id'       => $thisID,
      'accountType'        => 'main',
      'LicNumber'          => $the->LicNumber,
      'EmployerLicNumber'  => $the->EmployerLicNumber,
      'newRemID'           => $the->newRemID,
      'newRemOfficeID'     => $the->newRemOfficeID,]);
   //create merges with newRemailAgentID
   if(strpos($mergedWith,',')){
      //setup for each mergedAccount
      include(app_path().
      '/synch/agentPhotoLogo/functions/multipleMergeList.php');
   }else{
   //not multiple record
      include(app_path().
      '/synch/agentPhotoLogo/functions/singleMergeRecord.php');}}

//main accounts
foreach($theMain as $the){
   $thisID=$the->propagent_id;
   //sql
   $matchThese = array('propagent_id' =>$thisID);
   propagentcleanup::firstOrCreate($matchThese,[
      'propagent_id'       => $thisID,
      'accountType'        => 'main',
      'LicNumber'          => $the->LicNumber,
      'EmployerLicNumber'  => $the->EmployerLicNumber,
      'newRemID'           => $the->newRemID,
      'newRemOfficeID'     => $the->newRemOfficeID,]);}
