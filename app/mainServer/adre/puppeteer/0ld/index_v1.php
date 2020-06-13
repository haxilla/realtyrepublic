<?php

// Automatically goes to ADRE 
// & clicks the link to download files

//node json file (npm init --yes) was run in /js folder
$baseDir='/var/www/html/larasites/realtyrepublic/app/adre/puppeteer';
$jsNode=$baseDir.'/js';
$zipNode=$baseDir.'/zip';
//to check if exists
$individualsZip=$zipNode.'/Individuals.zip';
$entitiesZip=$zipNode.'/Entities.zip';

$zipExists=array();

if(file_exists($individualsZip)){
    $zipExists[]='Individuals';}

if(file_exists($entitiesZip)){
    $zipExists[]='Entities';}

dd($zipExists);

/*
// to run exec on node file
// first change directory; then run node files with 2>&1 
//Individuals.zip
$file1 = exec("cd $jsNode; node Individuals.js 2>&1", $out1, $err1);
//Entities.zip
$file2 = exec("cd $jsNode; node Entities.js 2>&1", $out2, $err2);
*/
//start log
include(app_path().'/adre/puppeteer/logs/synchLog.php');

//if files not found error
if(!file_exists($fullPath1) 
||!file_exists($fullPath2)){
	dd('error-line21-adre/puppeteer/index.php');}

//unzip files variables
$zip = new ZipArchive;
$extractPath=app_path().'/adre/puppeteer/extracts';
$finalPath=app_path().'/adre/puppeteer/files';

// test for existence
// these should be deleted on success
// to allow this as a valid test
// of previous synch success
if(file_exists($extractPath.'/Individuals.txt')
||file_exists($extractPath.'/Entities.txt')){
    dd("files exist!");
}else{
    dd("files NOT in existence");}

//open zips
//Individuals
$unzipped=$zip->open($fullPath1);
//extract
$extracted=$zip->extractTo($extractPath);
//close
$zip->close();
//if success
if($unzipped && $extracted){
	//set filename
	$extractFile=$extractPath.'/Individuals.txt';
	$finalFile=$finalPath.'/ADRE_agents.txt';
	$mainTable='ADRE_agents';
	
	//if successful
	if(file_exists($extractFile)){
		//run through regex
		include('regex/unescapedQuotes.php');
		//backup old data & prep for new
		include('mysql/tableReset.php'); 
		//load data infile
		include('mysql/loadDataInfile.php');

	}else{

        //failed zip extract
		//notify admin of error
		dd('error-line61-adre/puppeteer/downloadFile_exec.php');
    }
}

//Entities
if ($zip->open($fullPath2) === TRUE){
    //extract
    $extracted=$zip->extractTo($extractPath);
    //close
    $zip->close();
    //if success
    if($extracted){
    	//set filename
    	$extractFile=$extractPath.'/Entities.txt';
    	$finalFile=$finalPath.'/ADRE_entities.txt';
    	$mainTable='ADRE_entities';
    	
    	//if successful
    	if(file_exists($extractFile)){
    		//backup old data & prep for new
    		include('mysql/tableReset.php'); 
    		//load data infile
    		include('mysql/loadDataInfile.php');
    		//compare & log
    		include('mysql/compareLog.php');

    	}else{

            //failed admin extraction
    		//notify admin of error
    		dd('error-line97-adre/puppeteer/downloadFile_exec.php');}

    //failed zip open command
    }else{

    	//notify admin of error
    	dd('error-line103-adre/puppeteer/downloadFile_exec.php');}}