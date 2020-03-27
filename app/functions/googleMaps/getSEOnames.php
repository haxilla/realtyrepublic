<?php

use App\models\core\propflyer;
use App\models\core\propmapping;

$theMap=propmapping::where('propflyer_id','=',"$idFly")
->first();
$theFlyer=propflyer::where('id','=',"$idFly")
->first();

if(!$theMap||!$theFlyer){
   dd('error-line12-appPath/functions/googleMaps/getSEOnames.php');}

//get flyer variables
$xCity         = trim($theFlyer['xCity']);
$xState        = trim($theFlyer['xState']);
$xZip          = trim($theFlyer['xZip']);
if(!$xZip){
   $xZip=trim($theFlyer['xxZip']);}
$xFullStreet   = trim($theFlyer['xFullStreet']);
//error if missing
/*
if(!$xCity||!$xState||!$xZip||!$xFullStreet){
   dd('error-line21-appPath/functions/googleMaps/getSEOnames',$xCity,$xState,$xZip,$xFullStreet);}
*/
//SEOcity
$seoCity    = str_replace(' ', '_', $xCity);
$seoCity    = str_replace('.', '', $seoCity);
//SEOstate
$seoState   = $xState;
//SEOzip
$seoZip     = $xZip;
//SEOaddress
$seoAddress = str_replace(' ', '_', $xFullStreet);
$seoAddress = str_replace('.', '', $seoAddress);
$seoAddress = str_replace('#', '', $seoAddress);
$seoAddress="$seoAddress"."_"."$seoCity"."_"."$seoState";
$seoAddress=trim($seoAddress);
//GEOaddress
$geoAddress=str_replace('_', '+', $seoAddress);
//update
propmapping::where('propflyer_id','=',"$idFly")
->update([
   'seoCity'      => $seoCity,
   'seoState'     => $seoState,
   'seoZip'       => $seoZip,
   'seoAddress'   => $seoAddress,
   'geoAddress'   => $geoAddress,
]);
