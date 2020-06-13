<?php
//model
Use App\models\core\propoffice;
Use App\models\core\agtoffice;
//delete & recreate
propoffice::where('officeID','=',"$mainTempOfficeID")
->delete();
//adminID
$adminID=Auth::guard('admin')->user()->id;
//check tempOfficeID
if(!$tempOfficeID){
   //can be deleted later
   include(app_path().'/synch/tempOfficeID/set_tempOfficeID.php');}
//set officeName
$officeName=$adreEntity['DBAName'];
//if none use LegalName
if(!$officeName){
   $officeName=$adreEntity['LegalName'];}
//if still none, error
if(!$officeName){
   dd('error-line20-appPath/createAdreEntity');}
//propoffice
propoffice::create([
   'EmployerLicNumber'           => $EmployerLicNumber,
   'officeID'                    => $mainTempOfficeID,
   'tempOfficeID'                => $mainOldOfficeID,
   'armlsOfficeID'               => $thisArmlsOfficeID,
   'officeName'                  => $officeName,
   'officeLegal'                 => $adreEntity['officeLegal'],
   'officeDBAName'               => $adreEntity['DBAName'],
   'officeAddress1'              => $adreEntity['Address1'],
   'officeAddress2'              => $adreEntity['Address2'],
   'officeCity'                  => $adreEntity['City'],
   'officeState'                 => $adreEntity['State'],
   'officeZip'                   => $adreEntity['Zip'],
   'officeCounty'                => $adreEntity['County'],
   'officePhone'                 => $adreEntity['Phone'],
   'DesignatedBrokerLicNumber'   => $adreEntity['DesignatedBrokerLicNumber'],
   'officeClear'                 => \Carbon\Carbon::now(),
   'adminID'                     => $adminID,
]);
//update everyone in this office to new office
//may cause issue
include(app_path().'/adre/sql/update/agtOfficeUpdate.php');
