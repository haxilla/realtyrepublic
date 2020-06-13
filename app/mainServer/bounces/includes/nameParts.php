<?php

// takes full name & separates into first,middle & last
// and updates original email distribution database

$theModel		= 'App\models\oldEmails\\'.$theModel;
$nameParts 		= preg_split('/\s+/', $fullName);
$namepartCount	= count($nameParts);

if($namepartCount==3 && !$middleName){

	$firstName=$nameParts[0];
	$middleName=$nameParts[1];
	$lastName=$nameParts[2];
	$theModel::where('email','=',$thisEmail)
	->update([
		'FirstName'		=> $firstName,
		'middleName'	=> $middleName,
		'LastName'		=> $lastName,
	]);

}elseif((!$firstName || !$lastName) 
&& $namepartCount==2){

	$firstName=$nameParts[0];
	$lastName=$nameParts[1];
	$theModel::where('email','=',$thisEmail)
	->update([
		'FirstName'		=> $firstName,
		'LastName'		=> $lastName,
	]);
	
}elseif(!$fullName){

	$fullName=$firstName.' '.$middleName.' '.$lastName;
	$theModel::where('email','=',$thisEmail)
	->update([
		'FullName'=>$fullName,
	]);
}
