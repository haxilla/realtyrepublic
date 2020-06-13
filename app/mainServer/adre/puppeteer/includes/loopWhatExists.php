
<?php

//check which files already exist
if(file_exists($zipFilePath)){
	$zipExists[]=$className;
	$runNode=null;}
if(file_exists($extractFilePath)){
	$extractExists[]=$className;
	$runZip=null;}
if(file_exists($finalFilePath)){
	$finalExists[]=$className;
	$runFinal=null;}