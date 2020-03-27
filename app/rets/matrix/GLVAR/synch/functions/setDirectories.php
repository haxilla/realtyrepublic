<?php

//archive directory names
$theDateString=\Carbon\Carbon::now('UTC')->format('YmdHis');
$theDateFolder=\Carbon\Carbon::now('UTC')->format('Ymd');
$fileName=$thisSynch.'_'.$loopCount.'.csv';
$fileArch=$thisSynch.'_'.$loopCount.'-'.$theDateString.'.csv';

//base directory
if(!is_dir(app_path()."/rets/$retsSystem/$mlsName/files/$thisSynch")){
	mkdir(app_path()."/rets/$retsSystem/$mlsName/files/$thisSynch", 0777, true);}

//archived directories
if (file_exists(app_path()
	."/rets/$retsSystem/$mlsName/files/$thisSynch/$fileName")){

	if(!is_dir(app_path()
	."/rets/$retsSystem/$mlsName/files/$thisSynch/$theDateFolder")){
		mkdir(app_path()
		."/rets/$retsSystem/$mlsName/files/$thisSynch/$theDateFolder",0777, true);}
	//if so get date & append old filename with date
	rename(app_path()
	."/rets/$retsSystem/$mlsName/files/$thisSynch/$fileName",
	app_path()
	."/rets/$retsSystem/$mlsName/files/$thisSynch/$theDateFolder/$fileArch");
}