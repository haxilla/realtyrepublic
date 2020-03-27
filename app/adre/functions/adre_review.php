<?php

Use App\adre\models\adreAgent;

$licNumber=null;;
$employerLicNumber=null;
$licStatus=null;
$legalName=null;

$adreAgent=adreAgent::where('FirstName','=',$firstName)
->select('ADRE_agents.LicNumber as agtLic',
	'ADRE_agents.EmployerLicNumber as EmpLic',
	'ADRE_agents.LicStatus as agtLicStatus',
	'ADRE_agents.FirstName as FirstName',
	'ADRE_agents.LastName as LastName',
	'ADRE_agents.MiddleName as MiddleName',
	'ADRE_entities.LegalName as LegalName')
->where('LastName','=',$lastName)
->leftJoin('adre.ADRE_entities', function($join){
	$join->on(
		'adre.ADRE_agents.EmployerLicNumber',
		'=',
		'adre.ADRE_entities.LicNumber');
})->get();

$adreRecord=null;
$adreCount=$adreAgent->count();
//if results
if($adreAgent->count()==1){
	//sets variables
	foreach($adreAgent as $adre){
		include(app_path().'/adre/variables/adre_variables.php');}
}else{

	$adreAgent_error[]=[
		'fullName'=>$fullName,
	];
}

