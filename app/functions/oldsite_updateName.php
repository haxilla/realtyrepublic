<?php

$theModel::where('email','=',$thisEmail)
->update([
	'FirstName'		=> $firstName,
	'middleName'	=> $middleName,
	'LastName'		=> $lastName,
]);