<?php

// ****************************************** //
// *** Automatically goes to ADRE             //
// *** & clicks the link to download files    //
// ****************************************** //

//check log
include('logs/checkLog.php');

// set default variables
include('includes/defaultVariables.php');

//variables for each class
include('loopValues.php');

// loop above array
foreach($theLoop as $the){
    //loop variables
    include('includes/loopVariables.php');
    //check what exists
    include('includes/loopWhatExists.php');}

//if NO files found, run
if($runNode){
    include('includes/execNode.php');}

//if unzip needed
if($runZip){
    foreach($theLoop as $the){
        //loop variables
        include('includes/loopVariables.php');
        //unzip files
        include('includes/unzipAny.php');}}

//final processing of files
if($runFinal){

    //start loop
    foreach($theLoop as $the){
        
        //loop variables
        include('includes/loopVariables.php');
        
        //run regex if needed
        if($regexFile){
            // include regex
            include("regex/$regexFile");

        }else{
            // just move  
            copy("$extractFilePath", "$finalFilePath");};  

        //reset tables
        include('includes/tableResetAny.php');

        //load data infile
        include('includes/loadInfileAny.php');

        //compare log
        include('logs/thisCompare.php');

        //log as complete
        include('logs/thisComplete.php');

        //archive
        include('logs/thisArchive.php');

        //notate array
        $finalRan[]=$className;

    };//end loop    
};//end if

//send adminEmail
echo "ADRE Successful Synch of LogID: ".$logID;
exit();