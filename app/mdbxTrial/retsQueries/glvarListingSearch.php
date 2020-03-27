<?php
//include model
Use App\models\rets\glvarListing;
Use App\models\admin\importableTrial;

//first
if(!$trialAddress){

	//no address specified
	$getListings=glvarListing::where('ListAgentMLSID','=',$agtMlsID)
	->where('Status','=','Active')
	->select('Matrix_Unique_ID','MLSNumber','StreetNumberNumeric','StreetDirPrefix',
	'StreetName','StreetSuffix','UnitNumber','City','StateOrProvince',
	'PostalCode','SubdivisionName','BedsTotal','BathsTotal','SqFtTotal',
	'YearBuilt','ParkingDescription','Garage','Carports','PvPool',
	'PoolDescription','ListPrice','ListOfficeMLSID','ListOfficeName',
	'ListAgentFullName','ListAgentMLSID','MLSNumber','CountyOrParish',
	'CrossStreet','Directions','PublicRemarks','LotSqFt','Fireplaces',
	'FireplaceDescription','FireplaceLocation','VirtualTourLink',
	'AssociationFeaturesAvailable','Area')
	->get();

}else{

	//has address specified
	$first5=trim(substr($trialAddress, 0, 5));
	$nameOnly=trim(preg_replace('/\d/', '', $trialAddress));
	//query
	$getListings=glvarListing::where('ListAgentMLSID','=',$agtMlsID)
	->where('Status','=','Active')
	->where('MLSNumber','=',$trialAddress)
	->select('Matrix_Unique_ID','MLSNumber','StreetNumberNumeric','StreetDirPrefix',
		'StreetName','StreetSuffix','UnitNumber','City','StateOrProvince',
		'PostalCode','SubdivisionName','BedsTotal','BathsTotal','SqFtTotal',
		'YearBuilt','ParkingDescription','Garage','Carports','PvPool',
		'PoolDescription','ListPrice','ListOfficeMLSID','ListOfficeName',
		'ListAgentFullName','ListAgentMLSID','MLSNumber','CountyOrParish',
		'CrossStreet','Directions','PublicRemarks','LotSqFt','Fireplaces',
		'FireplaceDescription','FireplaceLocation','VirtualTourLink',
		'AssociationFeaturesAvailable','Area')
	->where(function($q) use($first5,$nameOnly,$trialAddress){
		$q->where('PublicAddress','LIKE','%'.$trialAddress.'%')
			->orWhere('MLSNumber','=',$trialAddress)
			->orWhere('PublicAddress','LIKE',$first5.'%')
			->orWhere('StreetNumber','LIKE',$first5.'%')
			->orWhere('StreetName','LIKE',$nameOnly.'%');
	})
	->get();
	
}

//set counts
$matchListings=$getListings->count();
$totalListings=glvarListing::where('ListAgentMLSID','=',$agtMlsID)
->count();
//update
importableTrial::where('sk1','=',$theKey)
->update([
	'matchListings' => $matchListings,
	'totalListings' => $totalListings,
]);

