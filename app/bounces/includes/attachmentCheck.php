<?php

//builds attachSafe keyword array
include(app_path().'/bounces/arrays/attachSafeKeys.php');

//check for attachments and
//creates safeAttach & unsafeAttach arrays
include(app_path().'/bounces/loops/attachLoop.php');
//if safe
if($safeAttach){
	//download
	include('attachmentDownload.php');}

//if unsafe
if($unsafeAttach){
	$unsafeFile=1;
	/*do something here*/}
