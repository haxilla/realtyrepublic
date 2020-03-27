<?php
//set model
Use App\models\rets\glvarAgent;
Use App\models\rets\glvarOffice;
//set theList
$theList=glvarAgent::where('MLSID','=',$mlsID)
->first();
//error if none
if(!$theList){
  dd('error-line8-listVariables_glvar');}

//main variables glvarAgent
$agtFirst         = $theList['FirstName'];
$agtLast          = $theList['LastName'];
$agtType          = $theList['agentType'];
$agtFullName      = $theList['FullName'];
$agtHomePhone     = $theList['CellPhone'];
$agtMlsID         = $theList['MLSID'];
$agtMainPhone     = $theList['DirectWorkPhone'];
$agtMobile        = $theList['CellPhone'];
$officeID         = $theList['OfficeMLSID'];
$glvarOfficeID		= 'glvar_'.$theList['officeMLSID'];
$matrixID			= $theList['Matrix_Unique_ID'];
$licenseNumber		= $theList['LicenseNumber'];
$licenseStatus 	= $theList['AgentStatus'];
$agtType 			= $theList['AgentType'];
$agtCounty        = 'TBD';
$agtBoard         = 'GLVAR';
$agtWebsite       = 'TBD';

//main variables glvarOffice
$theOffice=glvarOffice::where('MLSID','=',$officeID)
->first();

$officeName       = $theOffice['OfficeName'];
$officeAddress1   = $theOffice['StreetAddress'];
$officeCity       = $theOffice['StreetCity'];
$officeState      = $theOffice['StreetStateOrProvince'];
$officeZip        = $theOffice['StreetPostalCode'];
$officePhone      = $theOffice['Phone'];
$eidx             = 'glvar_'.$theList['MLSID'];