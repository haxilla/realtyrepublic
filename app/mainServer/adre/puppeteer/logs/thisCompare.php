<?php

//set model to update log
Use App\adre\models\adreLog;

//set variables
$backupTable=$mainTable."_backup";
$newCountField=$the['newCountField'];
$exCountField=$the['exCountField'];
$statusCountField=$the['statusCountField'];

//new query
$newQuery=DB::connection('adre')
->select( DB::raw("
	SELECT n.LicNumber
	FROM $mainTable n
	LEFT JOIN $backupTable o
	ON n.LicNumber=o.LicNumber 
	WHERE o.LicNumber IS NULL
	and n.LicNumber is not null
") );

//new query
$exQuery=DB::connection('adre')
->select( DB::raw("
	SELECT n.LicNumber
	FROM $mainTable n
	LEFT JOIN $backupTable o
	ON n.LicNumber=o.LicNumber 
	WHERE n.LicNumber IS NULL
	and o.LicNumber is not null
") );

//status query
$statusQuery=DB::connection('adre')
->select( DB::raw("
	SELECT n.LicNumber,n.LicStatus,o.LicStatus
	FROM $mainTable n
	LEFT JOIN $backupTable o
	ON n.LicNumber=o.LicNumber 
	WHERE o.LicStatus!=n.LicStatus
	AND o.LicStatus is not null
	and n.LicStatus is not null
") );

//get counts
$newCount=count($newQuery);
$statusCount=count($statusQuery);
$exCount=count($exQuery);

//update
adreLog::where('logID','=',$logID)
->update([
	$newCountField		=> $newCount,
	$statusCountField	=> $statusCount,
	$exCountField		=> $exCount
]);