<?php

//model
Use App\autosynch\models\agtoffice\agtoffices;

dd($the);

//variables
$thisAgent=$the->umid;
$thisPhoto=$the->agentPhoto;
$officeID=rawurlencode($the->officeID);
$newRemID=$the->newRemID;
$localFound=0;
$remoteFound=0;

// remote server defaults 
// to OID if null


//get localOfficeID
$getLocalOffice=agtoffices::where('propagent_id','=',$thisAgent)
->select('officeID')
->first();
$localOfficeID=$getLocalOffice['officeID'];

if(!$officeID){
	$officeID='OID';}
//
if(!$localOfficeID){
	$localOfficeID='OID';}

//error if any missing
if(!$thisAgent||!$thisPhoto||!$newRemID){
  dd('error-line22-agentphotoVariables.php '
  .$thisAgent.' '.$thisPhoto.' '.$newRemID);}

//set local path
$localPath="agentPhotos/$newRemID/$thisPhoto";;

//set remote paths
$remoteURL="http://www.realtyemails.com/HQoffice/$officeID/$thisPhoto";

//if local agtphoto found
if(file_exists($localPath)){
	$localFound=1;}
