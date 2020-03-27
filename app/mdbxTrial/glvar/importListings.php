<?php
//set models
Use App\models\core\agtoffice;
Use App\models\core\propflyer;
Use App\models\core\propflyerstat;
Use App\models\core\propmapping;
Use App\models\core\propmeta;
Use App\models\core\propremark;
Use App\models\core\propstyle;

//search rets
include(app_path().'/mdbxTrial/retsQueries/glvarListingSearch.php');

//get photos if less greater than 0 and less than 4 records
if($getListings->count()>0 && $getListings->count()<4){
	//login to rets
	include(app_path().'/rets/includes/login.php');
	//loop through records
	foreach($getListings as $the){
		//set variables
		include('listingVariables.php');
		//insert
		$newListing=propflyer::create([
			'propagent_id'=>$umid,
			'xMlsNum'=>$mlsNumber,
			'mlsName'=>'GLVAR',
			'officeID'=>$glvarOfficeID,
			'xListPrice'=>$listPrice,
			'xFullStreet'=>$xFullStreet,
			'xUnitNum'=>$unitNumber,
			'xCity'=>$city,
			'xState'=>$state,
			'xZip'=>$zip,
			'xCountyName'=>$county,
			'xSubdivision'=>$subdivision,
			'xBeds'=>$beds,
			'xBaths'=>$baths,
			'xSqft'=>$sqft,
			'xYrBuilt'=>$yrBuilt,
			'xPoolPvt'=>$poolYN,
			'xParking'=>$garageCount,
			'xFireplace'=>$fireplaceCount,
			'xLotSqft'=>$lotSqft,
			'xVirtualTour'=>$virtualTourLink,
		]);
		//get newID
		$newID=$newListing->id;
		//returns sk1
		include(app_path().'/members/keygens/mdbxGenPswd.php');
		include(app_path().'/members/keygens/mdbxBBSysIDgen.php');
		include(app_path().'/members/keygens/mdbxSysIDgen.php');
		$sysID='2'.$sysID;
		//propmeta
		propmeta::create([
			'propflyer_id'				=> $newID,
			'propagent_id'				=> $umid,
			'sk1'							=> $sk1,
			'sysID'						=> $sysID,
			'xSysID'						=> $xSysID,
			'bbSysID'					=> $bbSysID,
			'zipDir'						=> $zipDir,
			'mlsDir'						=> $mlsDir,
			'matrix_unique_id'		=> $uid,
			'createMethod'				=> 'rets_GLVAR',
			'manual'						=> 0,
		]);
		//propremark
		propremark::create([
			'propflyer_id'	=>	$newID,
			'propagent_ID'	=>	$umid,
			'xPubRemarks'	=> $pubRemarks,
			'xb1'				=> $xb1,
			'xb2'				=> $xb2,
			'xb3'				=> $xb3,
			'xb4'				=> $xb4,
			'xb5'				=> $xb5,
			'xb6'				=> $xb6,
			'xb7'				=> $xb7,
			'xb8'				=> $xb8,
		]);
		//propflyerstat
		propflyerstat::create([
			'propflyer_id'=>$newID,
			'propagent_id'=>$umid,
			'xDeliveryCount'=>0,
			'xAgtSent'=>0,
			'xAgtSentCount'=>0,
		]);
		//propmapping
		propmapping::create([
			'propflyer_id'=>$newID,
			'propagent_id'=>$umid,
			'xRegion'=>'SouthwestUSA', 
			'xHouseNum'=>$streetNumber,
			'xStreetDir'=>$streetPrefix,
			'xStreetName'=>$streetName,
			'xStreetSuffix'=>$streetSuffix,
			'mlsName'=>'GLVAR',
			'xMlsGrid'=>$mlsArea,
			'xCountyName'=>$county,
			'xSubdivision'=>$subdivision,
			'xIntersection'=>$crossStreet,
			'xDirections'=>$directions
		]);
		//propstyle defaults
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
		//scripts below require idFly variable
		$idFly=$newID;
		//Check for SEO names
		include(app_path().'/functions/googleMaps/getSEOnames.php');
		//gets googlat / googLng for google map
		include(app_path().'/functions/googleMaps/getGoogleMap.php');
		//check create directory
		include(app_path().'/mdbxTrial/makeListingDirectories.php');
		//get photos
		include(app_path().'/mdbxTrial/glvar/importPhotos.php');
		//resize photos
		include(app_path().'/mdbxTrial/functions/resizePhotos.php');


	}
}
//if greater than 3
if($getListings->count()>3){
	//choose the most recent instead
	
}