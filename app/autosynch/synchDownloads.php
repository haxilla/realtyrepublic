<?php

//download counts
include("variables/predownloadCounts.php");

if($currentSynch=='propphotoDownload'){

	include("downloads/propphotoDownload.php");

}elseif($currentSynch=='propphotoResize'){

	include("resize/resizeIndex.php");

}elseif($currentSynch=='agentphotoDownload'){

	include("downloads/agentphotoLoop.php");

}elseif($currentSynch=='agentlogoDownload'){

	include("downloads/agentlogoLoop.php");

}else{

	dd('error-line22-synchDownloads.php');}

//output json & exit
$idArray = array(
	'status'=>$status,
	'synchID'=>$synchID,
	'synchType'=>$synchType,
	'currentSynch'=>$currentSynch,
);

echo json_encode($idArray);
exit();