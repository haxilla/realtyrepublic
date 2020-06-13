<?php

$distroCount=0;
$eidx=null;
$last_hit=null;
$eidx_officeName=null;
$eidx_officeAddress1=null;
$legalName=null;
$agentLicNum=null;
$employerLicNum=null;
$agentLicStatus=null;
$adreCount=null;

$checkDistroArray=array(
	'aznaz','azsaz','azphxmetro','azphxne',
	'azphxse','azphxwv',
);

foreach($checkDistroArray as $check1){
	//set model
	$theModel='App\models\oldEmails\\'.$check1;

	// if all fields
	if($fullName && $firstName && $lastName && $thisEmail){
		// abbreviated for broader results
		$first5 = substr($firstName,0,5);
		$last5 = substr($lastName,0,5);
		// search by both email & name
		$thisCheck=$theModel::where('email','=',$thisEmail)
		->orWhere(function($q) Use($first5,$last5){
			$q->where('FirstName','LIKE','%'.$first5.'%')
			  ->where('LastName','LIKE','%'.$last5.'%');
		})
		->orWhere(function($q) Use($fullName){
			$q->where('FullName','=',$fullName);
		})
		->first();

	//if only $thisEmail or $fullName
	}elseif($thisEmail||$fullName){

		$thisCheck=$theModel::where('email','=',$thisEmail)
		->where(function($q) Use($fullName){
			$q->orWhere('FullName','=',$fullName);
		})
		->first();

	}else{
		dd('error-line42-distro_review.php');}

	//if found add
	if($thisCheck){
		//increment 
		$distroCount++;
		$eidx=$thisCheck['eidx'];
		$last_hit=$thisCheck['last_hit'];
		$eidx_officeName=$thisCheck['officename'];
		$eidx_officeAddress1=$thisCheck['officeaddress1'];
		$agentLicNum=$thisCheck['agentLicNum'];
		$employerLicNum=$thisCheck['employerLicNum'];
		$agentLicStatus=$thisCheck['agentLicStatus'];
		$adreCount=$thisCheck['adreCount'];
		//build array 
		$eidxFound[]=[
			'thisEmail'	=>$thisEmail,
			'theList'	=>$check1,
			'eidx'		=>$thisCheck['eidx'],
		];
	}
}

if(!$distroCount){
	$noEidx[]=[
		'uid'		=>$uid,
		'thisEmail'	=>$thisEmail,
	];}