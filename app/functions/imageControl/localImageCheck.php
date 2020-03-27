<?php
//this file should check the image
//and if validated update the database with localFound=1
//and add variable process to array
use App\models\oldsite\oldPhoto;
use App\models\core\propphoto;
use App\models\admin\photoChangeLog;

//get contents
$contents=@file_get_contents($localURL);
$autoDismissDate=\Carbon\Carbon::today()->addDays(5);

//check contents
if ($contents===FALSE){

	//clear all to force recheck
	//on all photos for this flyer

	//local
	propphoto::where('propflyer_id','=',$flyerID)
	->update([
		'existCheck'=>null,
		'localFound'=>0,
		'notFound'=>1,
	]);
	//remote update
	oldPhoto::where('propflyer_id','=',$flyerID)
	->update([
		'exist_check'=>null,
		'localFound'=>0,
		'notFound'=>1,
	]);

	// photoChangeLog
	photoChangeLog::create([
		'propflyer_id'		=> $flyerID,
		'propagent_id'		=> $agentID,
		'flyerAddress'		=> $flyerAddress,
		'localPhotoID'		=> $photoID,
		'localURL'			=> $localURL,
		'photoName'			=> $photoName,
		'localFoundBefore'	=> $localFound,
		'localFoundAfter'	=> 0,
		'notFoundBefore'	=> $notFound,
		'notFoundAfter'		=> 1,
		'remoteFoundBefore'	=> $remoteFound,
		'actionDesc'		=> 'Photo localFound=0 was Found Locally & Verified',
		'actionDetail'	=> 'Local & Remote - existCheck=now(), localFound=1, notFound=0',
		'photoStatus'		=> 'Verified',
		'section'			=> $section,
		'def'				=> $def,
		'ord'				=> $ord,
		'resized'			=> $resized,	
		'width'				=> $width,
		'height'			=> $height,
		'error'				=> 1,
	]);
	//mark as corrupt
	$photoData['Errors']['Corrupt'][$fi]['Photos'][$pi]['flyerAddress']=$flyerAddress;
	$photoData['Errors']['Corrupt'][$fi]['Photos'][$pi]['flyerID']=$flyerID;
	$photoData['Errors']['Corrupt'][$fi]['Photos'][$pi]['photoID']=$photoID;
	$photoData['Errors']['Corrupt'][$fi]['Photos'][$pi]['localURL']=$localURL;
	$photoData['Errors']['Corrupt'][$fi]['Photos'][$pi]['section']=$section;
}else{
	// contents OK
	//local update
	propphoto::where('photoID','=',$photoID)
	->update([
		'existCheck'	=> \Carbon\Carbon::now(),
		'localFound'	=> 1,
		'notFound'		=> 0,
	]);
	//remote update
	oldPhoto::where('photoID','=',$photoID)
	->update([
		'exist_check'	=> \Carbon\Carbon::now(),
		'localFound'	=> 1,
		'notFound'		=> 0,
	]);
	// photoChangeLog
	photoChangeLog::create([
		'propflyer_id'		=> $flyerID,
		'propagent_id'		=> $agentID,
		'flyerAddress'		=> $flyerAddress,
		'localPhotoID'		=> $photoID,
		'localURL'			=> $localURL,
		'photoName'			=> $photoName,
		'localFoundBefore'	=> $localFound,
		'localFoundAfter'	=> 1,
		'notFoundBefore'	=> $notFound,
		'notFoundAfter'		=> 0,
		'remoteFoundBefore'	=> $remoteFound,
		'actionDesc'		=> 'Photo localFound=0 was Found Locally & Verified',
		'actionDetail'	=> 'Local & Remote - existCheck=now(), localFound=1, notFound=0',
		'photoStatus'		=> 'Verified',
		'section'			=> $section,
		'autoDismissDate'	=> $autoDismissDate,
		'def'				=> $def,
		'ord'				=> $ord,
		'resized'			=> $resized,	
		'width'				=> $width,
		'height'			=> $height,
		'OK'				=> 1,
	]);
	//photoData array
	$photoData['OK']['Verified'][$fi]['Photos'][$pi]['flyerAddress']=$flyerAddress;
	$photoData['OK']['Verified'][$fi]['Photos'][$pi]['flyerID']=$flyerID;
	$photoData['OK']['Verified'][$fi]['Photos'][$pi]['flyerID']=$flyerID;
	$photoData['OK']['Verified'][$fi]['Photos'][$pi]['localURL']=$localURL;
	$photoData['OK']['Verified'][$fi]['Photos'][$pi]['section']=$section;
}