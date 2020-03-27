<?php

//models
Use App\models\core\propagentcleanup;
Use App\models\core\propflyer;

//get umid
$getUmid=propagentcleanup::where('newRemID','=',"$ajid")
->where(function($q){
  $q->where('accountType','=','main')
  ->orWhere('accountType','=',null);
})
->select('propagent_id')
->first();

//convert to ajid or use original
if(!$getUmid){
   $umid=$ajid;
}else{
   $umid=$getUmid['propagent_id'];}

//flyer list
$getFlyers=propflyer::where('propagent_id','=',"$umid")
->select('xFullStreet','creationDate','propagent_id','id',
   'xCity','xState','xZip','xxZip','xListPrice','xBeds','xxBeds',
   'xBaths','xxBaths','xSqft','xxSqft')
->whereHas('theStats',function($q){
    $q->where('xLastDeliveryDate','>',\Carbon\Carbon::now()->subdays(90));
})
->whereHas('thePhotos',function($q){
  $q->where('def','=','1')
    ->where('resized','=','500');
})
->with(['theAgent'=>function($q){
   $q->select(
   'id','agtFullName','agtFirst','agtLast','agtPhoto','agtMainPhone',
   'startDate','agtWebsite','agtURL','agtLogo')
      ->with(['theAgentCleanup'=>function($q){
         $q->select('propagent_id','newRemID');
      }]);
   }])
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName','def','resized',
    'width','height','orient','ratio','ord')
    ->where('resized','=','500')
    ->where(function($q){
      $q->where('def','=','1');
    });
}])
->with(['theMeta'=>function($q){
  $q->select('propflyer_id','zipDir','mlsDir','sk1');
}])
->with(['theOffice'=>function($q){
   $q->select('officeName','propagent_id','officeID','officeAddress1',
      'officeCity','officeState','officeZip');
}])
->orderBy('creationDate','desc')
->take(10)
->get();

//agent variables
$agtFullName=$getFlyers->first()->theAgent->agtFullName;
$agtFirst=$getFlyers->first()->theAgent->agtFirst;
$officeName=$getFlyers->first()->theOffice->officeName;
$officeID=$getFlyers->first()->theOffice->officeID;
$officeAddress=$getFlyers->first()->theOffice->officeAddress1;
$officeCity=$getFlyers->first()->theOffice->officeCity;
$officeState=$getFlyers->first()->theOffice->officeState;
$officeZip=$getFlyers->first()->theOffice->officeZip;
$officeCSZ=$officeCity.' '.$officeState.' '.$officeZip;
$agtURL=$getFlyers->first()->theAgent->agtURL;
$agtWebsite=$getFlyers->first()->theAgent->agtWebsite;
$agtMainPhone=$getFlyers->first()->theAgent->agtMainPhone;

//photo
if($getFlyers->first()->theAgent->agtPhoto){
  $agtPhoto=$getFlyers->first()->theAgent->agtPhoto;
}else{
  $agtPhoto=null;}

//logo
if($getFlyers->first()->theAgent->agtPhoto){
  $agtLogo=$getFlyers->first()->theAgent->agtLogo;
}else{
  $agtLogo=null;}

if($agtLogo=='logosample.gif'){
  $agtLogo=null;}
