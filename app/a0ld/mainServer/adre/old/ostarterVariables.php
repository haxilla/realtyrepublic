<?php
//model
use App\models\core\propagentmeta;
//set vars
$dupCheck=request('dupCheck');
$now=\Carbon\Carbon::now();
$sqlOK=request('sqlOK');
$LicNumber=request('LicNumber');
$nextRecord=request('nextRecord');
$deleteThis=0;
$EmployerLicNumber=request('EmployerLicNumber');
$adminID=\Auth::guard('admin')->user()->id;
$mergedWithSaves=NULL;
if(!$EmployerLicNumber){
   $deleteThis=1;}
//multipleAccounts
$multipleAccounts=0;
if(count($dupCheck)>1){
   $multipleAccounts=1;}
//prepare newRemID
$newRemID=propagentmeta::where('LicNumber','=',"$LicNumber")
->pluck('newRemID')
->first();
//set if none
if(!$newRemID){
   include(app_path().'/functions/keyGens/ezshortUID.php');
   $newRemID=$ezshortUID;}

//ok to remove from any pages ater this
$totalAgtPhotoDL=0;
$totalAgtLogoDL=0;
$totalAgtPhotoFound=0;
$totalAgtLogoFound=0;
$thisArmlsAgtID=NULL;
$agtPhotoError=0;
$agtLogoError=0;
$agtPhotoNotes=[];
$agtLogoNotes=[];

//setup dupLoop
$dupLoop=[];
