<?php

include('queries/resizeQuery.php');

//get totalRecords
$totalRecords=$resizeQuery->count();

//if no records completeLog
if($totalRecords<1){
  include(app_path().'/autosynch/log/completeLog.php');}

//function for resize
include('functions/smart_resize_image.php');

//get records
$resizePhoto=$resizeQuery
->take(1)
->get();

//loop
foreach($resizePhoto as $the){

	//report error
	if(!$the->theMeta){
		//update
		include('functions/noPropMeta.php');}

	//set dirs
	$zipDir     = $the->theMeta->zipDir;
    $mlsDir     = $the->theMeta->mlsDir;

	//error if missing
	if(!$zipDir||(!$mlsDir && $mlsDir !=0)){
		dd('error-line26-resizePhoto_w1000 '.$mlsDir.' '.$zipDir);}

	//set localURL
	$localURL="hqphotos/$zipDir/$mlsDir/$the->photoName";

	//check local
	if(file_exists($localURL)){

		//set localFound
		$localFound=1;
		//set dimensions
		include('variables/setDimensions.php');
		//check resize
		include('functions/checkResize.php');

	}else{

		//set notFound
		$notFound=1;
		include('functions/fileNotFound.php');}

}

