<?php

//default variables
$runNode=1;
$runZip=1;
$runFinal=1;
$nodeRan=null;
//array starters
$zipRan=array();
$finalRan=array();
$zipExists=array();
$txtExists=array();
//base directory
$baseDir='/var/www/html/larasites/realtyrepublic/app/adre/puppeteer';
//node js files // (npm init --yes) was run in /nodes folder
$nodeDir=$baseDir.'/nodes';
//file directories
$zipDir=$baseDir.'/files/zip';
$extractDir=$baseDir.'/files/extracts';
$finalDir=$baseDir.'/files/final';
$regexDir=$baseDir.'/regex';
//for later arrays
$zipExists=null;
$extractExists=null;
$finalExists=null;