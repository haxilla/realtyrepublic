<?php

//get all counts
include('allCounts.php');

//return html
$html=\View::make('admin.overlays.content.synchData')
->with([
	'responseOverlayTitle'	 => 'Synch Data ( '.$lastSynchDiff.' )',
	'responseOverlaySubtitle'=> "Last Synch: ".$lastSynchDate,
	'allorderCur'			 => $allorderCur,
	'allorderOld'			 => $allorderOld,
	'allorderDif'			 => $allorderDif,
	'propflyerCur'			 => $propflyerCur,
	'propflyerOld'			 => $propflyerOld,
	'propflyerDif'			 => $propflyerDif,
	'propstyleCur'			 => $propstyleCur,
	'propstyleOld'			 => $propstyleOld,
	'propstyleDif'			 => $propstyleDif,
	'propagentCur'			 => $propagentCur,
	'propagentOld'			 => $propagentOld,
	'propagentDif'			 => $propagentDif,
	'propphotoCur'			 => $propphotoCur,
	'propphotoOld'			 => $propphotoOld,
	'propphotoDif'			 => $propphotoDif,
	'propdelivCur'			 => $propdelivCur,
	'propdelivOld'			 => $propdelivOld,
	'propdelivDif'			 => $propdelivDif,
	'propdelivnowCur'		 => $propdelivnowCur,
	'propdelivnowOld'		 => $propdelivnowOld,
	'propdelivnowDif'	  	 => $propdelivnowDif,
	'deletepropflyerCur'	 => $deletepropflyerCur,
	'deletepropflyerOld'	 => $deletepropflyerOld,
	'deletepropflyerDif'	 => $deletepropflyerDif,
	'deletepropstyleCur'	 => $deletepropstyleCur,
	'deletepropstyleOld'	 => $deletepropstyleOld,
	'deletepropstyleDif'	 => $deletepropstyleDif,
	'deletepropphotoCur'	 => $deletepropphotoCur,
	'deletepropphotoOld'	 => $deletepropphotoOld,
	'deletepropphotoDif'  	 => $deletepropphotoDif,
	'emailremovalCur'		 => $emailremovalCur,
	'emailremovalOld'		 => $emailremovalOld,
	'emailremovalDif'		 => $emailremovalDif,
	'etrackCur'			 	 => $etrackCur,
	'etrackOld'			 	 => $etrackOld,
	'etrackDif'	 			 => $etrackDif,
	'propphotoDownload'		 => $propphotoDownload,
	'propphotoResize'		 => $propphotoResize,
	'agentphotoDownload'	 => $agentphotoDownload,
	'agentlogoDownload'		 => $agentlogoDownload

])->render();

//echo
echo $html;
//exit
exit();