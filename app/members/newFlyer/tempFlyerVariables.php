<?php
//models
Use App\models\smartyStreets\veraddfail;
Use App\models\smartyStreets\veraddress;
use App\models\core\propagent;
use App\models\core\tempflyer;
//query tempflyer
$tempflyer=tempflyer::where('mdbxid','=',"$mdbxid")
->where('propagent_id','=',"$umid")
->first();
//error if none
if(!$tempflyer){
   dd('error-line18-appPath/members/newFlyer/newPhotoUpload');}
//set variables
$DPB           = $tempflyer['DPB'];
$uFullStreet   = $tempflyer['tempFullStreet'];
$uCity         = $tempflyer['tempCity'];
$uState        = $tempflyer['tempState'];
$xZip          = $tempflyer['tempZip'];
$xMlsNum       = $tempflyer['tempMlsNum'];
$xUnitNum      = $tempflyer['tempUnitNum'];
$xIntersection = $tempflyer['tempIntersection'];
$xBeds         = $tempflyer['tempBeds'];
$xBaths        = $tempflyer['tempBaths'];
$xParking      = $tempflyer['tempParking'];
$xSqft         = $tempflyer['tempSqft'];
$xYrBuilt      = $tempflyer['tempYrBuilt'];
$xPoolPvt      = $tempflyer['tempPoolPvt'];
$xParking      = $tempflyer['tempParking'];
$xListPrice    = $tempflyer['tempListPrice'];
$xPubRemarks   = $tempflyer['tempPubRemarks'];
$propflyer_id  = $tempflyer['propflyer_id'];
$xSysID        = $tempflyer['xSysID'];
//officeID Query
$getOfficeID=propagent::where('id','=',"$umid")
->select('officeID')
->first();
//set officeID
$officeID=$getOfficeID['officeID'];

//if no zip find it
if(!$xZip){
   //check veraddress for zip
   $getZip=veraddress::where('mdbxid','=',"$mdbxid")
   ->first();
   //set xZip
   $xZip=$getZip['zipcode'];
   //if none try veraddfails
   if(!$xZip){
      $getZip=veraddfail::where('mdbxid','=',"$mdbxid")
      ->first();
      //set xZip
      $xZip=$getZip['xZip'];}
   //error if none
   if(!$xZip){
      dd('error-line33-tempFlyerVariables.php');}}

//if still no zip - error
if(!$xZip){
   dd('error-line52-tempFlyerVariables');}

//set zipDir
$zipDir=$xZip;
//set mlsDir
$mlsDir=$xSysID;
//change mlsDir to xMlsNum if present
if($xMlsNum){
   $mlsDir=$xMlsNum;}
