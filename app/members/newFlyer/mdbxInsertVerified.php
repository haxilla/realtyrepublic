<?php

use App\models\core\propflyer;
use App\models\core\propstyle;
use App\models\core\propmapping;
use App\models\core\propmeta;
use App\models\core\propremark;
use App\models\core\propflyerstat;

//uses values from smartyStreets verified response;
//needs $DPB variable set to work
@include('mdbxSmartyVariables.php');

// PROPFLYER - NEW INSERT / GENERATES newID
$newRec = propflyer::create([
   'propagent_id'    => $umid,
   'xMlsNum'         => $xMlsNum,
   'xFullStreet'     => $uFullStreet,
   'xCity'           => $uCity,
   'xState'          => $uState,
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

// GET newID
$newID=$newRec->id;
//PROPMAPPING with newID
propmapping::create([
	'propflyer_id' 	=> $newID,
	'propagent_id'		=> $umid,
	'DPB'					=> $DPB,
	'xHouseNum'			=> $xHouseNum,
	'xStreetDir'		=> $xStreetDir,
	'xStreetName'		=> $xStreetName,
	'xStreetSuffix'	=> $xStreetSuffix,
	'plus4_code'		=> $plus4_code,
	'xCountyName'		=> $xCountyName,
	'carrier_route'	=> $carrier_route,
	'sstrLat'			=> $sstrLat,
	'sstrLng'			=> $sstrLng,
	'dpv'					=> $dpv,
]);

//PROPMETA with newID
propmeta::create([
	'propflyer_id'		=> $newID,
	'propagent_id'		=>	$umid,
	'xSysID'				=> $xSysID,
	'sysID'				=> 'x'.$sysID.'x',
	'bbSysID'			=> $bbSysID,
	'sk1'					=> $sk1,
   'mdbxid'          => $mdbxid,
   'zipDir'          => $zipDir,
   'mlsDir'          => $mlsDir,
	'addressSource'	=> $addressSource
]);

propremark::create([
	'propflyer_id'	=> $newID,
	'propagent_id'	=> $umid
]);

//Create Entry
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
   'accentbars'         => '333333',
]);

propflyerstat::create([
   'propflyer_id' => $newID,
   'propagent_id' => $umid
]);
//set idFly for scripts below
$idFly=$newID;
//Check for SEO names
include(app_path().'/functions/googleMaps/getSEOnames.php');
//gets googlat / googLng for google map
include(app_path().'/functions/googleMaps/getGoogleMap.php');
