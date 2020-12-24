<?php
Use App\models\adre\adreNoMatch;
//make record
$matchThese = array('LicNumber' =>$LicNumber);
//create with newRemailAgentID
$propagentmeta=adreNoMatch::updateOrCreate($matchThese,[
   'LicNumber'    => $LicNumber,
   'noMatchDate'  => \Carbon\Carbon::now(),
]);

