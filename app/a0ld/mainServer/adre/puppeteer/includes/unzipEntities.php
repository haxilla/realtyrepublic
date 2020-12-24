<?php

//notate zipRan
$zipRan[]='Entities';
//unzip files variables
$zip = new ZipArchive;
//Individuals
$unzipped=$zip->open($entitiesZip);
//extract
$extracted=$zip->extractTo($extractPath);
//close
$zip->close();
//exit if error
if(!$unzipped||!$extracted){
	//notify admin of error

	//dd
	dd('error-line18-adre/puppeteer/includes/unzipEntities.php');}
