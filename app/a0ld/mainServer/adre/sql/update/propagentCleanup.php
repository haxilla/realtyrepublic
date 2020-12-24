<?php

//   ***   YOU ARE IN A LOOP        ***   //
//   ***   Current Record is $the   ***   //

Use App\models\core\propagentcleanup;

$thisID=$the['details']['metaIds']['propagent_id'];
$matchThese = array('propagent_id' =>$thisID);
//create with newRemailAgentID
propagentcleanup::updateOrCreate($matchThese,
[
   'accountType'              => 'merge',
   'mergedWith'               => $mainAccountID,
   'newRemID'                 => $newRemID,
   'LicNumber'                => $LicNumber,
   'EmployerLicNumber'        => $EmployerLicNumber,
   'EmployerLicNumberCheck'   => \Carbon\Carbon::now(),
   'LicNumberCheck'           => \Carbon\Carbon::now(),
]);
