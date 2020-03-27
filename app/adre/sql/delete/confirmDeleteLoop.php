<?php
//models
use App\models\core\agtoffice;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\oldsite\oldAgent;
//set adminID
$adminID=\Auth::guard('admin')->user()->id;
//loop
foreach($remailEventLog['allAccounts']['mainAccount'] as $t1){
   //set thisID
   $thisID=$t1['details']['metaIds']['propagent_id'];
   //update
   agtoffice::where('propagent_id','=',"$thisID")
   ->update([
      'agentConfirmDelete'=>1,
      'officeConfirmDelete'=>1,
      'agentDeleteReason'  => 'Terminated',
      'officeDeleteReason' => 'Terminated',
      'agentClear'=>\Carbon\Carbon::now(),
   ]);
   //realtyemails update
   oldAgent::where('umid','=',"$thisID")
   ->update([
      'confirmDelete'=>1,
      'agentClear'=>\Carbon\Carbon::now(),
   ]);}

if(array_key_exists('mergeAccount', $remailEventLog['allAccounts'])){
   foreach($remailEventLog['allAccounts']['mergeAccount'] as $t2){
      //set thisID
      $thisID=$t2['details']['metaIds']['propagent_id'];
      //update
      agtoffice::where('propagent_id','=',"$thisID")
      ->update([
         'agentConfirmDelete'=>1,
         'officeConfirmDelete'=>1,
         'agentDeleteReason'  => 'Inactive/Terminated',
         'officeDeleteReason' => 'Inactive/Terminated',
         'agentClear'=>\Carbon\Carbon::now(),
      ]);
      //check match
      $matchThese = array('propagent_id' =>$thisID);
      //update or create
      propagentcleanup::updateOrCreate($matchThese,
      [
         'accountType'              => 'Inactive/Terminated',
         'mergedWith'               => $mainAccountID,
         'newRemID'                 => $newRemID,
         'LicNumber'                => $LicNumber,
         'EmployerLicNumber'        => $EmployerLicNumber,
         'EmployerLicNumberCheck'   => \Carbon\Carbon::now(),
         'LicNumberCheck'           => \Carbon\Carbon::now(),
      ]);

      //realtyemails update
      oldAgent::where('umid','=',"$thisID")
      ->update([
         'confirmDelete'=>1,
         'agentClear'=>\Carbon\Carbon::now(),
      ]);}}
   //end foreachloop
//endif
//update propagentmeta to show terminated
propagentmeta::where('LicNumber','=',"$LicNumber")
->update([
   'LicStatus' => 'Terminated',
   'adminID'   => $adminID,]);

//check match
$matchThese = array('propagent_id' =>$mainAccountID);
//update or create
propagentcleanup::updateOrCreate($matchThese,
[
   'accountType'              => 'Inactive/Terminated',
   'mergedWith'               => $mainAccountID,
   'newRemID'                 => $newRemID,
   'LicNumber'                => $LicNumber,
   'EmployerLicNumber'        => $EmployerLicNumber,
   'EmployerLicNumberCheck'   => \Carbon\Carbon::now(),
   'LicNumberCheck'           => \Carbon\Carbon::now(),
]);
