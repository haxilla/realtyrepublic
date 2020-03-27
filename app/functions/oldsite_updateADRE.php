<?php

$theModel::where('email','=',$thisEmail)
->update([
	'agentLicNum'		=> $licNumber,
	'employerLicNum'	=> $employerLicNumber,
	'agentLicStatus'	=> $licStatus,
	'adreCount'			=> $adreCount,
	'checkLicDate'		=> \Carbon\Carbon::now(),
]);