<?php

// **   YOU ARE IN A LOOP
// **   $t['propagent_id']
// **   mergedWith
// **   $mainAccountID

use App\models\core\agtoffice;

if(!$EmployerLicNumber){
   $EmployerLicNumber=0;}

//dd($t['propagent_id']);
$thisID=$t['metaIds']['propagent_id'];
//update
$check=agtoffice::where('propagent_id','=',"$thisID")
->whereNull('newRemID')
->update([
   'mergedWith'            => $mainAccountID,
   'agentConfirmDelete'    => 1,
   'officeConfirmDelete'   => 1,
   'agentDeleteReason'     => 'Terminated',
   'officeDeleteReason'    => 'Terminated',
   'newRemID'              => $newRemID,
]);
