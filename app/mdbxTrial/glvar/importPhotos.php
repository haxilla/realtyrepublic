<?php
Use App\models\core\propphoto;
//get object
$largePhotos=$rets->GetObject("Property", "LargePhoto",$uid,'*','1');
//starting index
$n=1;
$isFirst=true;
foreach($largePhotos as $the){
	//skip first GLVAR currently duplicates index[0];
	if ($isFirst) {
		$isFirst = false;
		continue;}  
	$def=1;
	if($n>1){
		$def=0;}
	//get location
	$theFile=$the->getLocation();
	//dir path
	$dirPath="hqphotos/$zipDir/$mlsDir/";
	//filename
	$fileName=uniqid().'-'.$n.'.jpg';
	//fullPath
	$fullPath=$dirPath.$fileName;
	$fullOriginalPath=$dirPath.'original/'.$fileName;
	//download
	file_put_contents($fullOriginalPath, file_get_contents($theFile));
	//crop
	include(app_path().'/functions/imageControl/trimWhitespace3.php');
	//get dimensions 
	//list[0]=width, 
	//list[1]=height;
	$original=list($width, $height) = getimagesize($fullOriginalPath);
	$cropped=list($width, $height) = getimagesize($fullPath);
	$oWidth=$original[0];
	$cWidth=$cropped[0];
	$oHeight=$original[1];
	$cHeight=$cropped[1];
	//dimensions & filesizes
	$ratio=$width/$height;
	$ratio=round($ratio,4);
	$oldFileSize=filesize($fullOriginalPath);
	$newFileSize=filesize($fullPath);
	if($cWidth > $cHeight){
		$orient='wide';
	}else{
		$orient='tall';}
	//insert
	propphoto::create([
		'propflyer_id'		=> $newID,
		'propagent_id'		=> $umid,
		'photoName'			=> $fileName,
		'oldFileName'		=> $fileName,
		'def'					=> $def,
		'ord'					=> $n,
		'width'				=> $cWidth,
		'height'				=> $cHeight,
		'ratio'				=> $ratio,
		'originalWidth'	=> $oWidth,
		'originalHeight'	=> $oHeight,
		'oldFileSize'		=> $oldFileSize,
		'newFileSize'		=> $newFileSize,
		'resized'			=> 0,
		'resize_h'			=> $cHeight,
		'resize_w'			=> $cWidth,
		'orient'				=> $orient,
	]);
	//increment
	$n++;
}