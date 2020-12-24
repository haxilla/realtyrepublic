<?php

//notate array
$zipRan[]='Individuals';
//unzip files variables
$zip = new ZipArchive;
//Individuals
$unzipped=$zip->open($individualsZip);
//extract
$extracted=$zip->extractTo($extractPath);
//close
$zip->close();
//exit if error
if(!$unzipped||!$extracted){
	//notify admin of error

	//dd
	dd('error-line15-adre/puppeteer/includes/unzipIndividuals.php');}
