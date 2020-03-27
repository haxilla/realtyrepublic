<?php

//unzip files variables
$zip = new ZipArchive;
//Individuals
$unzipped=$zip->open($zipFilePath);
//extract
$extracted=$zip->extractTo($extractDir);
//close
$zip->close();
//exit if error
if(!$unzipped||!$extracted){
	//notify admin of error

	//dd
	dd('error-line15-adre/puppeteer/includes/unzipAny.php');}

//notate array
$zipRan[]=$className;