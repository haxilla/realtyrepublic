<?php
//model
use App\models\core\propoffice;

//propofficeAddress
$propofficeAddressQuery=propoffice::select('officeName','officeAddress1')
->Where(function($q)use($adreOfficeAddress3f,$adreOfficeAddress3r){
   $q->where('officeAddress1','LIKE','%'.$adreOfficeAddress3f.'%')
   ->where('officeAddress1','LIKE','%'.$adreOfficeAddress3r.'%');
})
->get();
//propofficeName
$propofficeNameQuery=propoffice::select('officeName','officeAddress1',
   'officeID','officeCity','officeState','officeZip','officeCounty')
->Where(function($q)use($adreOfficeName3f,$adreOfficeName3r){
   $q->where('officeName','LIKE','%'.$adreOfficeName3f.'%')
   ->where('officeName','LIKE','%'.$adreOfficeName3r.'%');
})
->get();
