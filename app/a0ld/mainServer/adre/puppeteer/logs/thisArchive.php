<?php

include(app_path().'/functions/directoryByDate.php');

//set archive folder
$archiveDir=$baseDir.'/files/archive/'.$className.'_'.$year.$month;
$archiveFile=$className.$year.$month.$day.'_'.$hour.$minute;
$archiveZipFile=$archiveFile.'.zip';
$archiveFinalFile=$archiveFile.'.txt';
$archiveZipPath="/$archiveDir/$archiveZipFile";
$archiveFinalPath="/$archiveDir/$archiveFinalFile";

//create directory if needed
if(!is_dir($archiveDir)){
	mkdir($archiveDir);}

//move & delete originals
rename($zipFilePath,$archiveZipPath);
unlink($extractFilePath);
rename($finalFilePath,$archiveFinalPath);