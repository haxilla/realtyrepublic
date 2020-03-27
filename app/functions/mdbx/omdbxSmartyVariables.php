<?php
//get models
use App\models\smartyStreets\veraddress;
//get vars
$get=veraddress::where('delivery_point_barcode','=',"$DPB")
->first();
//set vars
$delivery_point_check_digit 	= $get['delivery_point_check_digit'];
$xFullStreet		= $get['delivery_line_1'];
$last_line			= $get['last_line'];
$DPB 					= $get['delivery_point_barcode'];
$xHouseNum 			= $get['primary_number'];
$xStreetDir			= $get['street_predirection'];
$xStreetName		= $get['street_name'];
$xStreetSuffix		= $get['street_suffix'];
$xCity				= $get['city_name'];
$xState 				= $get['state_abbreviation'];
$xZip					= $get['zipcode'];
$plus4_code    	= $get['plus4_code'];
$xUnitDesig			= $get['secondary_designator'];
$xUnitNum			= $get['secondary_number'];
$delivery_point 	= $get['delivery_point'];
$record_type		= $get['record_type'];
$zip_type			= $get['zip_type'];
$county_fips		= $get['county_fips'];
$xCountyName		= $get['county_name'];
$carrier_route 	= $get['carrier_route'];
$sstrLat				= $get['latitude'];
$sstrLng				= $get['longitude'];
$dpv 					= $get['dpv_match_code'];
$addressSource		= 'smartyVerified';

/*

if (isset($getVer['metadata']['congressional_district'])){
	$congressional_district=trim($getVer['metadata']['congressional_district']);
}else{
	$congressional_district=null;
}
if (isset($getVer['metadata']['rdi'])){
	$rdi=trim($getVer['metadata']['rdi']);
}else{
	$rdi=null;
}
if (isset($getVer['metadata']['elot_sequence'])){
	$elot_sequence=trim($getVer['metadata']['elot_sequence']);
}else{
	$elot_sequence=null;
}
if (isset($getVer['metadata']['elot_sort'])){
	$elot_sort=trim($getVer['metadata']['elot_sort']);
}else{
	$elot_sort=null;
}

if (isset($getVer['metadata']['precision'])){
	$xPrecision=trim($getVer['metadata']['precision']);
}else{
	$xPrecision=null;
}
if (isset($getVer['metadata']['time_zone'])){
	$time_zone=trim($getVer['metadata']['time_zone']);
}else{
	$time_zone=null;
}
if (isset($getVer['metadata']['utc_offset'])){
	$utc_offset=trim($getVer['metadata']['utc_offset']);
}else{
	$utc_offset=null;
}
