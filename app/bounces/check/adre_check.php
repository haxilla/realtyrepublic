<?php

//set model
Use App\bounces\models\bounceWorksheet;
Use App\adre\models\adreAgent;

$adreAgent=adreAgent::where('FirstName','=',$the->firstName)
->select('ADRE_agents.LicNumber as agtLic',
	'ADRE_agents.EmployerLicNumber as EmpLic',
	'ADRE_agents.LicStatus as agtLicStatus',
	'ADRE_agents.FirstName as FirstName',
	'ADRE_agents.LastName as LastName',
	'ADRE_agents.MiddleName as MiddleName',
	'ADRE_entities.LegalName as LegalName')
->where('LastName','=',$the->lastName)
->leftJoin('adre.ADRE_entities', function($join){
	$join->on('adre.ADRE_agents.EmployerLicNumber','=','adre.ADRE_entities.LicNumber');
})->get();

if($adreAgent->count()>0){
	foreach($adreAgent as $adre){
		$adreFound[$the->fullName][]=[
			'email'				=>$the->email,
			'eidx'				=>$eidx,
			'firstName'			=>$adre['FirstName'],
			'lastName'			=>$adre['LastName'],
			'middleName'		=>$adre['MiddleName'],
			'licNumber'			=>$adre['agtLic'],
			'EmployerLicNumber'	=>$adre['EmpLic'],
			'licStatus'			=>$adre['agtLicStatus'],
			'legalName'			=>$adre['LegalName'],
		];}

	//if just one record update
	if($adreAgent->count()<2){
		bounceWorksheet::where('email','=',$the->email)
		->update([
			'licenseNumber'=>$adre['agtLic'],
			'licenseStatus'=>$adre['agtLicStatus'],
		]);}

}else{
	$adreNotFound[]=[
		'fullName'	=> $the->fullName,
		'email'		=> $the->email,
	];}

//update
bounceWorksheet::where('email','=',$the->email)
->update([
	'adreFound'=>$adreAgent->count(),
]);