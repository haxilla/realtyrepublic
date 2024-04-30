<?php

//model
Use App\autosynch\models\agtoffice\agtoffices;

dd($the);

//variables
$thisAgent=$the->umid;
$thisLogo=$the->logo;
$officeID=rawurlencode($the->officeID);
$localFound=0;
$remoteFound=0;

//query localOfficeID
$getLocalOffice=agtoffices::where('propagent_id','=',$thisAgent)
->select('officeID')
->first();

//set localOfficeID
$localOfficeID=$getLocalOffice['officeID'];

//
if(!$officeID && $officeID != 0){
	$officeID='OID';}
//
if(!$localOfficeID){
	$localOfficeID='OID';}

//error if any missing
if(!$thisAgent||!$thisLogo){
  dd('error-line30-agentlogoVariables.php '.$thisAgent.' '.$thisLogo);}

//set local path
$localPath="officeLogos/$localOfficeID/$thisLogo";
//set remote paths
$remoteURL="http://www.realtyemails.com/HQoffice/$officeID/logos/$thisLogo";

//if local agtphoto found
if(file_exists($localPath)){
	$localFound=1;}
