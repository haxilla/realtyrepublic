<?php

use App\models\core\propflyer;

$theDate=\Carbon\Carbon::today()->subDays(15);

//activeCampaigns
$activeCamps=propflyer::select('id',
   'propflyers.propagent_id','xFullStreet')
->whereHas('currentCamps',function($q){
   $q->where('emRequest','<=',\Carbon\Carbon::now());
})
->with(['currentCamps'=>function($q){
   $q->select('propflyer_id','cid','emArea',
      'emRequest','authorized');
}])
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName',
      'resized','width','height','orient')
   ->where('def','=','1');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir','sk1');
}])
->get();

//completeCampaigns
$completeCamps=propflyer::select('id',
   'propflyers.propagent_id',
   'xLastDeliveryDate','xFullStreet')
->whereNotNull('xLastDeliveryDate')
->where('xLastDeliveryDate','>',$theDate)
->with(['completeCamps'=>function($q){
   $q->select('cid','propflyer_id');
}])
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName',
      'resized','width','height','orient')
      ->where('def','=','1');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir','sk1');
}])
->leftJoin('propflyerstats','propflyer_id','id')
->orderBy('xLastDeliveryDate','desc')
->get()
->take(20);

//set completeCamp variables
/*
$completeCampCount=$completeCampaigns->count();
$completeCampaigns=$completeCampaigns->get()->take(15);
$completeFlyers=$completeCampaigns->groupBy('id');
*/