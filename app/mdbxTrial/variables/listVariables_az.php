<?php
//set variable model name
$appPrefix = 'App\models\distro\\';
$modelName=$appPrefix.$listName;
//get list
$theList=$modelName::where('agtEmail','=',$trialEmail)
->first();
//error if none
if(!$theList){
	dd('error-line10-listVariables_az');}

//main variables phoenix
$agtFirst         = $theList['agtFirst'];
$agtLast          = $theList['agtLast'];
$agtType          = $theList['agtType'];
$agtFullName      = $theList['agtFullName'];
$agtHomePhone     = $theList['agtHomePhone'];
$agtMlsID         = $theList['agtMlsID'];
$agtMainPhone     = $theList['agtMobile'];
$agtMobile        = $theList['agtMobile'];
$officeID         = $theList['officeID'];
$agtCounty        = $theList['agtCounty'];
$agtBoard         = $theList['agtBoard'];
$agtWebsite       = $theList['agtWeb'];
$officeName       = $theList['officeName'];
$officeAddress1   = $theList['officeAddress1'];
$officeAddress2   = $theList['officeAddress2'];
$officeCity       = $theList['officeCity'];
$officeState      = $theList['officeState'];
$officeZip        = $theList['officeZip'];
$officePhone      = $theList['officePhone'];
$eidx             = $theList['eidx'];

if(!$officeID){
	$officeID='OID';}

if($agtWebsite=='NULL'){
	$agtWebsite=NULL;}

//combine if both fields are there for now
if($officeAddress1 && $officeAddress2 && $officeAddress2 !== 'NULL'){
   $officeAddress1=$officeAddress1.' '.$officeAddress2;}
