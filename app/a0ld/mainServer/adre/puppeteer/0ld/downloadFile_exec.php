<?php

// Automatically goes to ADRE 
// & clicks the link to download files

//node json file (npm init --yes) was run in folder
$theNode='/var/www/html/larasites/realtyrepublic/app/adre/puppeteer';
//search puppeteer2 (www-data)
$theNode2=$theNode.'2';

/*
//Individuals.zip
$file1 = exec("cd $theNode; node Individuals.js 2>&1", $out, $err);
//Entities.zip
$file2 = exec("cd $theNode; node Entities.js 2>&1", $out, $err);
*/

//to check if exists
$fullPath1=$theNode2.'/Individuals.zip';
$fullPath2=$theNode2.'/Entities.zip';

//if files not found error
if(!file_exists($fullPath1) 
||!file_exists($fullPath2)){
	dd('error-line18-adre/puppeteer/downloadFile_exec.php');}

//unzip files variables
$zip = new ZipArchive;
$extractPath=app_path().'/adre/puppeteer2/extracts';
$finalPath=app_path().'/adre/puppeteer2/files';

//open zips
//Individuals
if ($zip->open($fullPath1) === TRUE){
    //extract
    $extracted=$zip->extractTo($extractPath);
    //close
    $zip->close();
    //if success
    if($extracted){
    	//set filename
    	$extractFile=$extractPath.'/Individuals.txt';
    	$finalFile=$finalPath.'/Individuals.txt';
    	$mainTable='adreagents';
    	
    	//if successful
    	if(file_exists($extractFile)){
    		//run through regex
    		include('regex/unescapedQuotes.php');
    		//backup old data & prep for new
    		include('mysql/tableReset.php'); 
    		//load data infile
    		include('mysql/loadDataInfile.php');
    		//compare & log
    		include('mysql/compareLog.php');

    	}else{

    		//notify admin of error
    		dd('error-line49-adre/puppeteer/downloadFile_exec.php');}

    //failed zip extraction
    }else{

    	//notify admin of error
    	dd('error-line42-adre/puppeteer/downloadFile_exec.php');}}

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
    	$finalFile=$finalPath.'/Entities.txt';
    	$mainTable='adreentities';
    	
    	//if successful
    	if(file_exists($extractFile)){
    		//run through regex
    		include('regex/unescapedQuotes.php');
    		//backup old data & prep for new
    		include('mysql/tableReset.php'); 
    		//load data infile
    		include('mysql/loadDataInfile.php');
    		//compare & log
    		include('mysql/compareLog.php');

    	}else{

    		//notify admin of error
    		dd('error-line49-adre/puppeteer/downloadFile_exec.php');}

    //failed zip extraction
    }else{

    	//notify admin of error
    	dd('error-line42-adre/puppeteer/downloadFile_exec.php');}}
if ($zip->open($fullPath2) === TRUE){
    //extract
    $extracted=$zip->extractTo($extractPath);
    //close
    $zip->close();

    if($extracted){
    	
    	//set filename
    	$extractFile=$extractPath.'/Entities.txt';
    	$finalFile=$finalPath.'/Entities.txt';
    	//run through regex to fix unescaped quotes
    	if(file_exists($extractFile)){
    		include('regex/unescapedQuotes.php');
    	}else{
    		dd('error-line49-adre/puppeteer/downloadFile_exec.php');}
    	
    	//begin synch

    }else{
    	dd('error-line42-adre/puppeteer/downloadFile_exec.php');}

}

//php_unlink($fullPath1);