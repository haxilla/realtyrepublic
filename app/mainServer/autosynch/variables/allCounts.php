<?php
//last synch
	//query
	$lastSynchCheck=App\models\synch\synchLog::select('synchStart')
	->where('synchType','=','synchAll')
	->orderBy('synchStart','desc')
	->first();

	if($lastSynchCheck){
		//get Diff
		$lastSynchDiff=$lastSynchCheck['synchStart']
		->diffForHumans();
		//get Date
		$lastSynchDate=$lastSynchCheck['synchStart']
		->setTimezone(new DateTimeZone('America/Phoenix'))
		->toDayDateTimeString();
	}else{
		//set null
		$lastSynchDiff=null;
		$lastSynchDate=null;}

//Counts
	//agtoffice
	$agtofficeCur=App\autosynch\models\agtoffice\agtofficeCur::count();
	$agtofficeOld=App\autosynch\models\agtoffice\agtofficeOld::count();
	$agtofficeDif=$agtofficeOld-$agtofficeCur;
	//allorder
	$allorderCur=App\autosynch\models\allorder\allorderCur::count();
	$allorderCurArc=App\autosynch\models\allorder\allorderCurArc::count();
	$allorderOld=App\autosynch\models\allorder\allorderOld::count();
	$allorderOldArc=App\autosynch\models\allorder\allorderOldArc::count();
	$allorderOld=$allorderOld+$allorderOldArc; //adjust for arc
	$allorderDif=$allorderOld-$allorderCur;
	//deleteflyer
	$deletepropflyerCur=App\autosynch\models\deletepropflyer\deletepropflyerCur::count();
	$deletepropflyerOld=App\autosynch\models\deletepropflyer\deletepropflyerOld::count();
	$deletepropflyerDif=$deletepropflyerOld-$deletepropflyerCur;
	//deletephoto
	$deletepropphotoCur=App\autosynch\models\deletepropphoto\deletepropphotoCur::count();
	$deletepropphotoOld=App\autosynch\models\deletepropphoto\deletepropphotoOld::count();
	$deletepropphotoDif=$deletepropphotoOld-$deletepropphotoCur;
	//deletestyle
	$deletepropstyleCur=App\autosynch\models\deletepropstyle\deletepropstyleCur::count();
	$deletepropstyleOld=App\autosynch\models\deletepropstyle\deletepropstyleOld::count();
	$deletepropstyleDif=$deletepropstyleOld-$deletepropstyleCur;
	//emailremoval
	$emailremovalCur=App\autosynch\models\emailremoval\emailremovalCur::count();
	$emailremovalOld=App\autosynch\models\emailremoval\emailremovalOld::count();
	$emailremovalDif=$emailremovalOld-$emailremovalCur;
	//etrack
	$etrackCur=App\autosynch\models\etrack\etrackCur::count();
	$etrackOld=App\autosynch\models\etrack\etrackOld::count();
	$etrackDif=$etrackOld-$etrackCur;
	//propagent
	$propagentCur=App\autosynch\models\propagent\propagentCur::count();
	$propagentOld=App\autosynch\models\propagent\propagentOld::count();
	$propagentDif=$propagentOld-$propagentCur;
	//propdeliv
	$propdelivCur=App\autosynch\models\propdeliv\propdelivCur::count();
	$propdelivCurArc=App\autosynch\models\propdeliv\propdelivCurArc::count();
	$propdelivOld=App\autosynch\models\propdeliv\propdelivOld::count();
	$propdelivOldArc=App\autosynch\models\propdeliv\propdelivOldArc::where(
		'emailfinished','<','2019-01-01'
	)->count();
	$propdelivOld=$propdelivOldArc+$propdelivOld;
	$propdelivDif=$propdelivOld-$propdelivCur;


	//propdelivnow
	$propdelivnowCur=App\autosynch\models\propdelivnow\propdelivnowCur::count();
	$propdelivnowOld=App\autosynch\models\propdelivnow\propdelivnowOld::whereNull('emailfinished')->whereNotNull('emailrequested')->count();
	$propdelivnowDif=$propdelivnowOld-$propdelivnowCur;
	//propflyer
	$propflyerCur=App\autosynch\models\propflyer\propflyerCur::count();
	$propflyerCurArc=App\autosynch\models\propflyer\propflyerCurArc::count();
	$propflyerOld=App\autosynch\models\propflyer\propflyerOld::count();
	$propflyerOldArc=App\autosynch\models\propflyer\propflyerOldArc::count();
	$propflyerOld=$propflyerOld+$propflyerOldArc;  //adjust for arc
	$propflyerDif=$propflyerOld-$propflyerCur;
	//propflyerstat
	$propflyerstatCur=App\autosynch\models\propflyerstat\propflyerstatCur::count();
	$propflyerstatOld=App\autosynch\models\propflyerstat\propflyerstatOld::count();
	$propflyerstatDif=$propflyerstatOld-$propflyerstatCur;
	//propmapping
	$propmappingCur=App\autosynch\models\propmapping\propmappingCur::count();
	$propmappingOld=App\autosynch\models\propmapping\propmappingOld::count();
	$propmappingDif=$propmappingOld=$propmappingCur;
	//propmeta
	$propmetaCur=App\autosynch\models\propmeta\propmetaCur::count();
	$propmetaOld=App\autosynch\models\propmeta\propmetaOld::count();
	$propmetaDif=$propmetaOld-$propmetaCur;
	//propphoto
	$propphotoCur=App\autosynch\models\propphoto\propphotoCur::count();
	$propphotoCurArc=App\autosynch\models\propphoto\propphotoCurArc::count();
	$propphotoOld=App\autosynch\models\propphoto\propphotoOld::count();
	$propphotoOldArc=App\autosynch\models\propphoto\propphotoOldArc::count();
	$propphotoOld=$propphotoOld+$propphotoOldArc;
	$propphotoDif=$propphotoOld-$propphotoCur;
	//propremark
	$propremarkCur=App\autosynch\models\propremark\propremarkCur::count();
	$propremarkOld=App\autosynch\models\propremark\propremarkOld::count();
	$propremarkDif=$propremarkOld-$propremarkCur;
	//propstyle
	$propstyleCur=App\autosynch\models\propstyle\propstyleCur::count();
	$propstyleCurArc=App\autosynch\models\propstyle\propstyleCurArc::count();
	$propstyleOld=App\autosynch\models\propstyle\propstyleOld::count();
	$propstyleOldArc=App\autosynch\models\propstyle\propstyleOldArc::count();
	$propstyleOld=$propstyleOld+$propstyleOldArc;
	$propstyleDif=$propstyleOld-$propstyleCur;

	$propphotoDownload=App\autosynch\models\downloads\propphotoDownload::downloadCount();
	$propphotoResize=App\autosynch\models\downloads\propphotoResize::downloadCount();
	$agentphotoDownload=App\autosynch\models\downloads\agentphotoDownload::downloadCount();
	$agentlogoDownload=App\autosynch\models\downloads\agentlogoDownload::downloadCount();

/* 

	PROPER WAY TO DATE SEARCH FOR A YEAR
	
	***************************
	where date >= "2019-01-01"
	and   date <"2020-01-01"
	***************************

*/



