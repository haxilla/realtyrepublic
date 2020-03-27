<?php
//any altered/cropped versions are the ones used
if(!is_dir("agentPhotos/$newRemID")){
	//create if doesnt exist
	mkdir("agentPhotos/$newRemID", 0777, true);
}else{
	$files = glob("agentPhotos/$newRemID/*"); //get all file names
	//clean directory if exists
	foreach($files as $file){
		if(is_file($file))
		unlink($file);}
}

//original version storage
if(!is_dir("agentPhotos/$newRemID/original")){
	//create if doesnt exist
	mkdir("agentPhotos/$newRemID/original", 0777, true);
}else{
	$files = glob("agentPhotos/$newRemID/original/*"); //get all file names
	//clean directory if exists
	foreach($files as $file){
		if(is_file($file))
		unlink($file);}
}