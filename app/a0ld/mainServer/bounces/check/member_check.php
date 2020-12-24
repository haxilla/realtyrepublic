<?php

//set model
Use App\bounces\models\bounceWorksheet;
Use App\models\core\propagent;

$firstName=$the->firstName;
$lastName=$the->lastName;
$email=$the->email;

$first5 = substr($firstName,0,5);
$last5 = substr($lastName,0,5);

$getMembers=propagent::where('agtFirst','like','%'.$first5.'%')
->where('agtLast','like','%'.$last5.'%')
->orWhere(function($q) Use($email){
	$q->where('xxAgtUname','=',$email)
	->orWhere('agtEmail','=',$email);
})->get();

if($getMembers->count()>0){

	foreach($getMembers as $members){
		$memberFound[$the->fullName][]=[
			'email'			=>$email,
			'fullName'		=>$the->fullName,
			'email'			=>$the->email,
			'first5'		=>$first5,
			'last5'			=>$last5,
			'memberFirst'	=>$members->agtFirst,
			'memberLast'	=>$members->agtLast,
			'xxAgtUname'	=>$members->xxAgtUname,
			'memberEmail'	=>$members->agtEmail,
			'startDate'		=>$members->startDate,
			'expireDate'	=>$members->expireDate,
			'accountType'	=>$members->accountType,
			'remCreds'		=>$members->remCreds,
			'umid'			=>$members->id,];

		if($getMembers->count()<2){
			bounceWorksheet::where('email','=',$the->email)
			->update([
				'umid'			=> $members->id,	
				'memberFound'	=> $getMembers->count(),
			]);}}}

//update
bounceWorksheet::where('email','=',$the->email)
->update([
	'memberFound'=>$getMembers->count(),
]);



