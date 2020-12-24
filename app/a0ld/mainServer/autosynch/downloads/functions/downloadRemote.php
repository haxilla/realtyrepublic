<?php

if($remoteFound==1){
	//make directory if needed
	if (!is_dir("hqphotos/$zipDir/$mlsDir")) {
	  mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
	//get file
	file_put_contents($localURL, file_get_contents($remoteURL));}

if($deleteFound==1){
	//set to deletes
	$localURL="photodeletes/$zipDir/$mlsDir/$photoName";
	//make directory if needed
	if (!is_dir("photodeletes/$zipDir/$mlsDir")) {
	  mkdir("photodeletes/$zipDir/$mlsDir", 0777, true);}
	//get file
	file_put_contents($localURL, file_get_contents($remoteURL));}

//check for local and reset localFound
if(file_exists($localURL)){
	$localFound=1;
}else{
	dd('error-line22-downloadRemote.php');}
