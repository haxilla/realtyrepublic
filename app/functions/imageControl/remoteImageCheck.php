<?php
//models
use App\models\core\propphoto;
use App\models\oldsite\oldFlyer;
use App\models\oldsite\oldPhoto;
use App\models\admin\photoChangeLog;
//check original URL
$oldFlyer=oldFlyer::where('ufid','=',$flyerID)
->select('mlsDir','zipDir')
->first();
//get original directory
$oldZipDir=$oldFlyer['zipDir'];
$oldMlsDir=$oldFlyer['mlsDir'];
//using rawurlencode converts spaces to %20
$encZipDir=rawurlencode($oldZipDir);
$encMlsDir=rawurlencode($oldMlsDir);
//original remoteURL
$remoteURL="http://www.realtyemails.com/hqPhotos/$oldZipDir/$oldMlsDir/$photoName";
$remoteURLencode="http://www.realtyemails.com/hqPhotos/$encZipDir/$encMlsDir/$photoName";
//try existence at remote server
$contents=@file_get_contents($remoteURLencode);
//check contents
if ($contents===FALSE){
	// local clear entire flyer photos
	// to force re-check later
	propphoto::where('propflyer_id','=',$flyerID)
	->update([
		'existCheck'=>null,
		'localFound'=>0,
		'remoteFound'=>0,
		'notFound'=>1,
	]);
	// remote clear entire flyer photos 
	// to force check on all
	oldPhoto::where('ufid','=',$flyerID)
	->update([
		'exist_check'=>null,
		'localFound'=>0,
		'remoteFound'=>0,
		'notFound'=>1,
	]);
	//add changes to photoChangeLog
	photoChangeLog::create([
		'propflyer_id'		=> $flyerID,
		'propagent_id'		=> $agentID,
		'flyerAddress'		=> $flyerAddress,
		'photoName'			=> $photoName,
		'localPhotoID'		=> $photoID,
		'localURL'			=> $localURL,
		'remoteURL'			=> $remoteURL,
		'remoteURLencode'	=> $remoteURLencode,
		'localFoundBefore'	=> $localFound,
		'localFoundAfter'	=> 0,
		'notFoundBefore'	=> $notFound,
		'notFoundAfter'		=> 1,
		'remoteFoundBefore'	=> $remoteFound,
		'remoteFoundAfter'	=> 0,
		'actionDesc'		=> 'File Not Found on local or Remote',
		'actionDetail'	=> 'Local & Remote - existCheck=null, localFound=0, notFound=1,remoteFound=0',
		'photoStatus'		=> 'NotFound',
		'section'			=> $section,
		'def'				=> $def,
		'ord'				=> $ord,
		'resized'			=> $resized,	
		'width'				=> $width,
		'height'			=> $height,
		'error'				=> 1,
	]);

	//photoData array
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['remoteFound']=0;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['flyerID']=$flyerID;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['flyerAddress']=$flyerAddress;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['photoName']=$photoName;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['section']=$section;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['localURL']=$localURL;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]['remoteURL']=$remoteURL;
	$photoData['Errors']['NotFound'][$fi]['Photos'][$pi]
	['remoteURLencode']=$remoteURLencode;
	

}else{

	//make directory if needed
    if (!is_dir("hqphotos/$zipDir/$mlsDir")){
    	mkdir("hqphotos/$zipDir/$mlsDir", 0777, true);}
    //download remote file
    file_put_contents($localURL, file_get_contents($remoteURLencode));
    //set contents for localURL
    $contents=@file_get_contents($localURL);
    //error if none
    if($contents===FALSE){
    	dd('error-line93-app/functions/imageControl/remoteImageCheck.php');}

    // local clear entire flyer photos
	// to force re-check later
	propphoto::where('propflyer_id','=',$flyerID)
	->update([
		'existCheck'=>null,
		'localFound'=>0,
		'remoteFound'=>0,
		'notFound'=>1,
	]);
	// remote clear entire flyer photos 
	// to force check on all
	oldPhoto::where('ufid','=',$flyerID)
	->update([
		'exist_check'=>null,
		'localFound'=>0,
		'remoteFound'=>0,
		'notFound'=>1,
	]);

	//update the one photo that fixed
	//local
	propphoto::where('photoID','=',$photoID)
	->update([
		'existCheck'=>\Carbon\Carbon::now(),
		'localFound'=>1,
		'remoteFound'=>1,
		'notFound'=>0,
	]);
	//remote
	oldPhoto::where('photoID','=',$photoID)
	->update([
		'exist_check'=>\Carbon\Carbon::now(),
		'localFound'=>1,
		'remoteFound'=>1,
		'notFound'=>0,
	]);

	// remote contents OK
	// photoChangeLog FIXED
	photoChangeLog::create([
		'propflyer_id'		=> $flyerID,
		'propagent_id'		=> $agentID,
		'flyerAddress'		=> $flyerAddress,
		'localPhotoID'		=> $photoID,
		'localURL'			=> $localURL,
		'remoteURL'			=> $remoteURL,
		'remoteURLencode'	=> $remoteURLencode,
		'photoName'			=> $photoName,
		'localFoundBefore'	=> $localFound,
		'localFoundAfter'	=> 1,
		'notFoundBefore'	=> $notFound,
		'notFoundAfter'		=> 0,
		'remoteFoundBefore'	=> $remoteFound,
		'remoteFoundAfter'	=> 1,
		'actionDesc'		=> 'Previously notFound File Downloaded From Remote',
		'actionDetail'	=> 'Local & Remote - existCheck=now(), localFound=1,remoteFound=1, notFound=0',
		'photoStatus'		=> 'Fixed',
		'section'			=> $section,
		'def'				=> $def,
		'ord'				=> $ord,
		'resized'			=> $resized,	
		'width'				=> $width,
		'height'			=> $height,
		'OK'				=> 1,
	]);

	//photoData array
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['remoteFound']=1;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['flyerID']=$flyerID;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['flyerAddress']=$flyerAddress;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['photoName']=$photoName;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['section']=$section;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['localURL']=$localURL;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['remoteURL']=$remoteURL;
	$photoData['OK']['Fixed'][$fi]['Photos'][$pi]['remoteURLencode']=$remoteURLencode;
}

