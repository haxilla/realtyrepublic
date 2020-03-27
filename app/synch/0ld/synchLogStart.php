<?php

include('allCounts.php');

//start new log
$newLog=synchLog::create([
	'allorderOld'		=> $allOrderOld,      	//
	'allorderNew'		=> $allOrderNew,		//
	'emailremovalNew'	=> $emailRemovalNew,	//
	'emailremovalOld'	=> $emailRemovalOld,	//
	'propagentNew'		=> $propagentNew,		//
	'propagentOld'		=> $propagentOld,		//
	'propdelivNew'		=> $propdelivNew,		//
	'propdelivOld'		=> $propdelivOld,		//
	'propdelivnowNew'	=> $propdelivnowNew,	//
	'propdelivnowOld'	=> $propdelivnowOld,	//
	'propflyerNew'		=> $propflyerNew,		//
	'propflyerOld'		=> $propflyerOld,		//
	'propphotoNew'		=> $propphotoNew,
	'propphotoOld'		=> $propphotoOld,
	'propstyleNew'		=> $propstyleNew,
	'propstyleOld'		=> $propstyleOld,
	'agtoffice'			=> $agtOffice,
	'propflyerstat'		=> $propflyerstat,
	'propmeta'			=> $propmeta,
	'propmapping'		=> $propmapping,
	'propremark'		=> $propremark
]);

//retrieve id
$synchID=$newLog['synchID'];

//set array
$idArray = array(
	'status'  		=> $status,
	'synchStartPhx'	=> $synchStartPhx,
	'next'    		=> $nextSynch,
	'synchID'		=> $synchID,
);

//echo json & exit
echo json_encode($idArray);
exit();