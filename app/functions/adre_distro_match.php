<?php

//*** WORKING FUNCTION NOT IN USE RIGHT NOW ***//
//takes list names in array
//loops through distro lists
//and finds connected ADRE records
//as well as fixing missing first & last names

$checkDistroArray=array(
	'aznaz','azsaz','azphxmetro','azphxne',
	'azphxse','azphxwv',
);

foreach($checkDistroArray as $check1){
	//set model
	$theModel='App\models\oldEmails\\'.$check1;

	$needsFix=$theModel::whereNotNull('FullName')
	->where('FullName','!=',"")
	->where(function($q){
		$q->whereNull('adreCount')
		  ->orWhereNull('FirstName')
		  ->orWhereNull('LastName');
		})
	->select('FirstName','middleName','email',
		'LastName','FullName','eidx')
	->get();

	foreach($needsFix as $the){
		//must have full name
		if(!isset($the->FullName)){
			dd($the,'error-line23-adre_distro_match.php');}
		
		//$thisEmail set for function below
		$thisEmail=$the->email;
		$fullName=$the->FullName;
		$firstName=$the->FirstName;
		$lastName=$the->LastName;
		
		$fullName=trim($fullName);
		//fix firstName & lastName
		if(!isset($firstName)
		||!isset($lastName)){	
			//takes in $fullName & returns $first,$middle,$last
			include(app_path().'/functions/name_splitter.php');
			if($firstName && $lastName){
				//updates data on oldsite
				include(app_path().'/functions/oldsite_updateName.php');}}

		// retrieves variable about 
		// adre record by $firstName, $lastName
		include(app_path().'/adre/functions/adre_review.php');
		//update oldsite records
		include(app_path().'/functions/oldsite_updateADRE.php');
	}
}