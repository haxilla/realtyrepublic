<?php

if(!is_dir("hqphotos/$zipDir/$mlsDir")){
	//create if doesnt exist
	mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);
}else{
	$files = glob("hqphotos/$zipDir/$mlsDir/*"); //get all file names
	//clean directory if exists
	foreach($files as $file){
		if(is_file($file))
		unlink($file);}
}
if(!is_dir("hqphotos/$zipDir/$mlsDir/original")){
	//create if doesnt exist
	mkdir("hqphotos/$zipDir/$mlsDir/original", 0777, true);
}else{
	$files = glob("hqphotos/$zipDir/$mlsDir/original/*"); //get all file names
	//clean directory if exists
	foreach($files as $file){
		if(is_file($file))
		unlink($file);}
}