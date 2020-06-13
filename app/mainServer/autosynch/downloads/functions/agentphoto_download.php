<?php

//make directory if needed
if(!is_dir("agentPhotos/$newRemID")){
  mkdir("agentPhotos/$newRemID", 0777, true);}

//get image
file_put_contents($localPath, file_get_contents($remoteURL));

//error if not found
if(!file_exists($localPath)){
	dd('error-line12-agentphoto_download.php');}
