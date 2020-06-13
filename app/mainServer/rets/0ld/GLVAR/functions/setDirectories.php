<?php

//archive directory names
$theDateString=\Carbon\Carbon::now('UTC')->format('YmdHis');
$theDateFolder=\Carbon\Carbon::now('UTC')->format('Ymd');

//base directory
if(!is_dir(app_path()."/rets//GLVAR/files/listings")){
	mkdir(app_path()."/rets/GLVAR/files/listings", 0777, true);}

//archived directories
if (file_exists(app_path()."/rets/GLVAR/files/listings/listings_$loopCount.csv")) {

	if(!is_dir(app_path()."/rets/GLVAR/files/listings/$theDateFolder")){
		mkdir(app_path()."/rets/GLVAR/files/listings/$theDateFolder", 0777, true);}
	//if so get date & append old filename with date
	rename(app_path()."/rets/GLVAR/files/listings/listings_$loopCount.csv",
	app_path()."/rets/GLVAR/files/listings/$theDateFolder/listings_$loopCount-$theDateString.csv");
	/*
	//delete old file
	unlink(app_path()."/rets/files/propertySearch$loopCount.csv");
	*/
}