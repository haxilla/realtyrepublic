<?php

//default variables
$runNode=1;
$runZip=1;
$nodeRan=null;
$zipRan=array();
$zipExists=array();
$txtExists=array();
//node json file (npm init --yes) was run in /js folder
$baseDir='/var/www/html/larasites/realtyrepublic/app/adre/puppeteer';
$jsDir=$baseDir.'/js';
$zipDir=$baseDir.'/zip';
//set paths & files
$individualsZip=$zipDir.'/Individuals.zip';
$entitiesZip=$zipDir.'/Entities.zip';
$extractPath=app_path().'/adre/puppeteer/extracts';
$finalPath=app_path().'/adre/puppeteer/files';
$individualsTxt=$extractPath.'/Individuals.txt';
$entitiesTxt=$extractPath.'/Entities.txt';