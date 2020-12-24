<?php

//add to array
if(file_exists($individualsZip)){
    $zipExists[]='Individuals';}
//add to array
if(file_exists($entitiesZip)){
    $zipExists[]='Entities';}
// if file exists
// do not run exec
if($zipExists){
    $runNode=null;}

// add to array if exists
if(file_exists($individualsTxt)){
    $txtExists[]='Individuals';}
if(file_exists($entitiesTxt)){
    $txtExists[]='Entities';}
// if txt file exists
// dont run unzips
if($txtExists){
    $runZip=null;}