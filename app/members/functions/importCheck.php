<?php 

Use App\models\member\importableTrial;

//query 
$checkImport=importableTrial::where('propagent_id','=',$umid)
->select('matchListings','mlsName','listName','mlsID')
->first();

//set default variables
$importCount	= $checkImport['matchListings'];
$mlsName		= $checkImport['mlsName'];
$mlsID 			= $checkImport['mlsID'];
$importList		= null;

//if imports available
if($importCount>0){
	//check mlsName
	if($mlsName=='glvar'){
		include(app_path().'/members/imports/glvar.php');}}
