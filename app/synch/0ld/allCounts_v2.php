<?php
//set models
	//agtoffice
	$agtofficeCur=\App\models\autosynch\agtoffice\agtOfficeCur::count();
	$agtofficeOld=\App\models\autosynch\agtoffice\agtOfficeOld::count();
	$agtofficeDif=$agtofficeOld-$agtofficeCur;
	//allorder
	$allorderCur=\App\models\autosynch\allorder\allorderCur::count();
	$allorderOld=\App\models\autosynch\allorder\allorderOld::count();
	$allorderDif=$allorderOld-$allorderCur;
	//deleteflyer
	$deleteflyerCur=\App\models\autosynch\deleteflyer\deleteflyerCur::count();
	$deleteflyerOld=\App\models\autosynch\deleteflyer\deleteflyerOld::count();
	$deleteflyerDif=$deleteflyerOld-$deleteflyerCur;
	//deletephoto
	$deletephotoCur=\App\models\autosynch\deletephoto\deletephotoCur::count();
	$deletephotoOld=\App\models\autosynch\deletephoto\deletephotoOld::count();
	$deletephotoDif=$deletephotoOld-$deletephotoCur;
	//deletestyle
	$deletestyleCur=\App\models\autosynch\deletestyle\deletestyleCur::count();
	$deletestyleOld=\App\models\autosynch\deletestyle\deletestyleOld::count();
	$deletestyleDif=$deletestyleOld-$deletestyleCur;
	//emailremoval
	$emailremovalCur=\App\models\autosynch\emailremoval\emailremovalCur::count();
	$emailremovalOld=\App\models\autosynch\emailremoval\emailremovalOld::count();
	$emailremovalDif=$emailremovalOld-$emailremovalCur;
	//etrack
	$etrackCur=\App\models\autosynch\etrack\etrackCur::count();
	$etrackOld=\App\models\autosynch\etrack\etrackOld::count();
	$etrackDif=$etrackOld-$etrackCur;
	//propagent
	$propagentCur=\App\models\autosynch\propagent\propagentCur::count();
	$propagentOld=\App\models\autosynch\propagent\propagentOld::count();
	$propagentDif=$propagentOld-$propagentCur;
	//propdeliv
	$propdelivCur=\App\models\autosynch\propdeliv\propdelivCur::count();
	$propdelivOld=\App\models\autosynch\propdeliv\propdelivOld::count();
	$propdelivDif=$propdelivOld-$propdelivCur;
	//propdelivnow
	$propdelivnowCur=\App\models\autosynch\propdelivnow\propdelivnowCur::count();
	$propdelivnowOld=\App\models\autosynch\propdelivnow\propdelivnowOld::count();
	$propdelivnowDif=$propdelivnowOld-$propdelivnowCur;
	//propflyer
	$propflyerCur=\App\models\autosynch\propflyer\propflyerCur::count();
	$propflyerOld=\App\models\autosynch\propflyer\propflyerOld::count();
	$propflyerDif=$propflyerOld-$propflyerCur;
	//propflyerstat
	$propflyerstatCur=\App\models\autosynch\propflyerstat\propflyerstatCur::count();
	$propflyerstatOld=\App\models\autosynch\propflyerstat\propflyerstatOld::count();
	$propflyerstatDif=$propflyerstatOld-$propflyerstatCur;
	//propmapping
	$propmappingCur=\App\models\autosynch\propmapping\propmappingCur::count();
	$propmappingOld=\App\models\autosynch\propmapping\propmappingOld::count();
	$propmappingDif=$propmappingOld=$propmappingCur;
	//propmeta
	$propmetaCur=\App\models\autosynch\propmeta\propmetaCur::count();
	$propmetaOld=\App\models\autosynch\propmeta\propmetaOld::count();
	$propmetaDif=$propmetaOld-$propmetaCur
	//propphoto
	$propphotoCur=\App\models\autosynch\propphoto\propphotoCur::count();
	$propphotoOld=\App\models\autosynch\propphoto\propphotoOld::count();
	$propphotoDif=$propphotoOld-$propphotoCur;
	//propremark
	$propremarkCur=\App\models\autosynch\propremark\propremarkCur::count();
	$propremarkOld=\App\models\autosynch\propremark\propremarkOld::count();
	$propremarkDif=$propremarkOld-$propremarkCur;
	//propstyle
	$propstyleCur=\App\models\autosynch\propstyle\propstyleCur::count();
	$propstyleOld=\App\models\autosynch\propstyle\propstyleOld::count();
	$propstyleDif=$propstyleOld-$propremarkCur;

	



/*
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

*/
/*
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
*/