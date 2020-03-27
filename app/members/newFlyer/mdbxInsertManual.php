<?php

use App\models\core\propflyer;
use App\models\core\propmapping;
use App\models\core\propmeta;
use App\models\core\propremark;
use App\models\core\propstyle;
use App\models\core\propflyerstat;

// PROPFLYER - NEW INSERT / GENERATES newID
$newRec = propflyer::create([
	'propagent_id'		=> $umid,
   'xMlsNum'         => $xMlsNum,
	'xFullStreet'		=> $uFullStreet,
	'xCity'				=> $uCity,
	'xState'				=> $uState,
   'xZip'            => $xZip,
   'xListPrice'      => $xListPrice,
   'xBeds'           => $xBeds,
   'xBaths'          => $xBaths,
   'xSqft'           => $xSqft,
   'xYrBuilt'        => $xYrBuilt,
   'xPoolPvt'        => $xPoolPvt,
   'xParking'        => $xParking,
   'officeID'        => $officeID,
]);

// GET newID assign to idFLy
$newID=$newRec->id;
$idFly=$newID;
//PROPMAPPING with newID
propmapping::create([
	'propflyer_id' 	=> $newID,
	'propagent_id'		=> $umid,
   'xIntersection'   => $xIntersection
]);
//set dir for propmeta table
$zipDir=$xZip;
$mlsDir=$xSysID;
if($xMlsNum){
   $mlsDir=$xMlsNum;}
//PROPMETA
propmeta::create([
	'propflyer_id'		=> $newID,
	'propagent_id'		=>	$umid,
	'xSysID'				=> $xSysID,
	'sysID'				=> 'x'.$xSysID.'x',
	'bbSysID'			=> $bbSysID,
	'sk1'					=> $sk1,
	'zipDir'				=> $zipDir,
   'mlsDir'          => $mlsDir,
   'mdbxid'          => $mdbxid,
	'addressSource'	=> 'unverified-userSupplied'
]);
//set bullets
$xb1=$xBeds.' Bedrooms';
$xb2=$xBaths.' Bathrooms';
$xb3=$xSqft.' Square Feet';
$xb4='Built in '.$xYrBuilt;
if($xPoolPvt==='Yes'){
   $xb5="Private Pool";
}elseif($xPoolPvt==='Community'){
   $xb5="Community Pool";
}else{
   $xb5="No Pool";
}
$xb6='Parking: '.$xParking;
$xb7='For More Info...';
$xb8='Contact Listing Agent';
//create remarks entry
propremark::create([
	'propflyer_id'	=> $newID,
	'propagent_id'	=> $umid,
   'xPubRemarks'  => $xPubRemarks,
   'xb1'          => $xb1,
   'xb2'          => $xb2,
   'xb3'          => $xb3,
   'xb4'          => $xb4,
   'xb5'          => $xb5,
   'xb6'          => $xb6,
   'xb7'          => $xb7,
   'xb8'          => $xb8,
]);
//create style entry
propstyle::create([
   'propflyer_id'       => $newID,
   'propagent_id'       => $umid,
   'flyer_background'   => 'cccccc',
   'headline_bar_bg'    => '333333',
   'headline_bar_text'  => 'ffffff',
   'headline_text'      => '333333',
   'graphic_words'      => 'greatbuy',
   'graphic_textcolor'  => 'ffffff',
   'graphic_style'      => 'ul',
   'roundedtop'         => 'roundedtop-600px_cccccc.gif',
   'accentbars'         => '333333',
]);
//create propflyerstat
propflyerstat::create([
   'propflyer_id' => $newID,
   'propagent_id' => $umid,
]);
//Check for SEO names
include(app_path().'/functions/googleMaps/getSEOnames.php');
//gets googlat / googLng for google map
include(app_path().'/functions/googleMaps/getGoogleMap.php');
