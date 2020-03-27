<?php

$uid=$the['Matrix_Unique_ID'];
$zipDir=$the['PostalCode'];
$mlsDir=$the['MLSNumber'];
$streetNumber=$the['StreetNumberNumeric'];
$streetPrefix=$the['StreetDirPrefix'];
$streetName=$the['StreetName'];
$streetSuffix=$the['StreetSuffix'];
$unitNumber=$the['UnitNumber'];
$city=$the['City'];
$state=$the['StateOrProvince'];
$zip=$the['PostalCode'];
$subdivision=$the['SubdivisionName'];
$beds=$the['BedsTotal'];
$baths=$the['BathsTotal'];
$sqft=$the['SqFtTotal'];
$yrBuilt=$the['YearBuilt'];
$parkingDesc=$the['ParkingDescription'];
$garageCount=$the['Garage'];
$carportCount=$the['Carports'];
$poolYN=$the['PvPool'];
$poolDesc=$the['PoolDescription'];
$listPrice=$the['ListPrice'];
$listOfficeMLSID=$the['ListOfficeMLSID'];
$glvarOfficeID='GLVAR_'.$listOfficeMLSID;
$listOfficeName=$the['ListOfficeName'];
$listAgentFullName=$the['ListAgentFulllName'];
$ListAgentMLSID=$the['ListAgentMLSID'];
$mlsNumber=$the['MLSNumber'];
$county=$the['CountyOrParish'];
$crossStreet=$the['CrossStreet'];
$directions=$the['Directions'];
$pubRemarks=$the['PublicRemarks'];
$lotSqft=$the['LotSqFt'];
$fireplaceCount=$the['Fireplaces'];
$fireplaceDesc=$the['FireplaceDescription'];
$fireplaceLocation=$the['FireplaceLocation'];
$virtualTourLink=$the['VirtualTourLink'];
$associationFeaturesAvailable=$the['AssociationFeaturesAvailable'];
$mlsArea=$the['Area'];
//set pool
if($poolYN=='1'){
	$poolBullet="Private Pool";
}elseif(strpos($associationFeaturesAvailable,"Pool")!==false){
	$poolBullet="Community Pool";
}else{
	$poolBullet="No Pool";}

//set parking
if($garageCount>0){
	$parkingBullet=$garageCount." Car Garage";
}elseif($carportCount>0){
	$parkingBullet=$carportCount." Car Carport";
}elseif($parkingDesc){
	$parkingBullet=$parkingDesc;
}else{
	$parkingBullet='Open Parking';}

//bullets
$xb1=$beds." Bedrooms";
$xb2=$baths." Bathrooms";
$xb3=$sqft." Sqft.";
$xb4="Built in ".$yrBuilt;
$xb5=$parkingBullet;
$xb6=$poolBullet;
$xb7="";
$xb8="";

//set full address
$streetPlus=trim($streetPrefix.' '.$streetName.' '.$streetSuffix);
$xFullStreet=$streetNumber.' '.$streetPlus;
//add unit if present
if($unitNumber && $unitNumber!=0 && $unitNumber !='N/A'){
	$xFullStreet=$xFullStreet.' '.$unitNumber;}