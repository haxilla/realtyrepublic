<?php

//set models

//oldsite
use App\models\oldsite\oldAgent;
use App\models\oldsite\deleteFlyerOld;
use App\models\oldsite\deleteStyleOld;
use App\models\oldsite\deletePhotoOld;
use App\models\oldsite\oldetrack2019;
use App\models\oldsite\oldFlyer;
use App\models\oldsite\oldPhoto;
use App\models\oldsite\oldDeliv; //remaildeliveriesmaster
use App\models\oldsite\oldDeliv2019;
use App\models\oldsite\oldDelivNow;
use App\models\oldsite\oldOrder;
use App\models\oldsite\oldOrderCC;
use App\models\oldsite\oldEmailRemoval;

//newsite
use App\models\core\propflyer;
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\core\propphoto;
use App\models\core\propdeliv;
use App\models\core\propdelivnow;
use App\models\core\allorder;
use App\models\distro\emailRemoval;
use App\models\etrack\etrack2019;
use App\models\maindata\cleanRemailFlyer;
use App\models\maindata\newDeliv2019;
use App\models\delete\deleteFlyerNew;
use App\models\delete\deleteStyleNew;
use App\models\delete\deletePhotoNew;

//photos
	$photoOldCount=oldPhoto::count();
	$photoCurCount=propphoto::count();

//agents
	$agtCurCount=propagent::count();
	//remove google company from results
	//rules out nulls if you dont include
	//orWhereNull in statement
	$agtOldCount=oldAgent::where('agentcompany','!=','google')
	->orWhereNull('agentCompany')
	->count();
	//breaches in new server
	$agtCurBreachCount=agtoffice::where('officeName','=','google')
	->count();
	//subtract breaches
	$agtCurFinalCount=$agtCurCount-$agtCurBreachCount;
	//determine records to synch
	$agtSynchCount=$agtOldCount-$agtCurFinalCount;
	//aka
	$propagentNew=$agtCurFinalCount;
	$propagentOld=$agtOldCount;

//flyers
	$flyerOldCount=oldFlyer::count();
	$flyerCurCount=propflyer::count();
	$flyerArcCount=cleanRemailFlyer::count();
	$flyerCurFinalCount=$flyerCurCount-$flyerArcCount;
	$flyerSynchCount=$flyerOldCount-$flyerCurFinalCount;
	//aka
	$propflyerOld=$flyerOldCount;
	$propflyerNew=$flyerCurFinalCount;

//propdeliv
	//old
	$propdelivOld=oldDeliv::count();
	$propdelivNew=propDeliv::count();

//deliveries2010
	$oldDeliv2019=oldDeliv2019::count();
	$newDeliv2019=newDeliv2019::count();


//propdelivnow

	//count requested & unfinished
	$propdelivnowOld=oldDelivNow::whereNotNull('emailrequested')
	->whereNull('emailfinished')
	->count();

	$propdelivnowNew=propdelivnow::count();

//orders
	$oldOrderCount=oldOrder::count();
	$oldOrderCCCount=oldOrderCC::count();
	//two tables combined for allOrder table on new server
	$allOrderOld=$oldOrderCount+$oldOrderCCCount;
	$allOrderNew=allorder::count();

//emailRemovals
	$emailRemovalOld=oldEmailRemoval::count();
	$emailRemovalNew=emailRemoval::count();

//etrack2019
	$etrack2019Old=oldEtrack2019::count();
	$etrack2019New=etrack2019::count();

//deletes
	//flyer
	$deleteFlyerOld=deleteFlyerOld::count();
	$deleteFlyerNew=deleteFlyerNew::count();
	//style
	$deleteStyleOld=deleteStyleOld::count();
	$deleteStyleNew=deleteStyleNew::count();
	//photo
	$deletePhotoOld=deletePhotoOld::count();
	$deletePhotoNew=deletePhotoNew::count();