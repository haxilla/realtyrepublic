<?php

// ****************************************** //
// *** Automatically goes to ADRE             //
// *** & clicks the link to download files    //
// ****************************************** //

//set default variables
include('includes/defaultVariables.php');

//array to run through
$theLoop[]=['individuals','entities'];

//determine which files already exist
include('includes/whatExists.php');

//if no existing files found, run
if($runNode){
    include('includes/execNode.php');}

//if unzip needed
if($runZip){
    //unzip each
    foreach($theLoop[0] as $thisLoop){
        //set thisZip
        $theZipFile=${"$thisLoop".'Zip'};
        //uses thisZip
        include('includes/unzipAny.php');}}

dd($nodeRan,$zipRan);