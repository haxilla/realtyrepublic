<?php

//model
Use App\models\core\agtoffice;
//update agtoffice
agtoffice::where('propagent_id','=',"$mainAccountID")
->update([
   'EmployerLicNumber'           => $EmployerLicNumber,
   'armlsOfficeID'               => $thisArmlsOfficeID,
   'officeName'                  => $adreEntity['DBAName'],
   'officeAddress1'              => $adreEntity['Address1'],
   'officeAddress2'              => $adreEntity['Address2'],
   'officeCity'                  => $adreEntity['City'],
   'officeState'                 => $adreEntity['State'],
   'officeZip'                   => $adreEntity['Zip'],
   'officeCounty'                => $adreEntity['County'],
]);
