<?php 

Use App\models\core\propflyer;

//query active camps
$activeCampaigns=propflyer::select('id',
   'propflyers.propagent_id','xFullStreet')
->where('propflyers.propagent_id','=',"$umid")
->whereHas('currentCamps',function($q){
   $q->where('emRequest','<=',\Carbon\Carbon::now());
})
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName','def')
   ->where('def','=','1')
   ->where('resized','=','500');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir','sk1');
}]);

//query completed camps
$completeCampaigns=propflyer::select('id',
   'propflyers.propagent_id',
   'xLastDeliveryDate','xFullStreet')
->whereNotNull('xLastDeliveryDate')
->where('propflyers.propagent_id','=',"$umid")
->doesntHave('currentCamps')
->with(['completeCamps'=>function($q){
   $q->select('cid','propflyer_id');
}])
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName','def')
   ->where('def','=','1')
   ->where('resized','=','500');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir','sk1');
}])
->leftJoin('propflyerstats','propflyer_id','id')
->orderBy('xLastDeliveryDate','desc');

//query
$unsentFlyers=propflyer::select('id',
   'propflyers.propagent_id','xFullStreet','creationDate')
->leftJoin('propflyerstats','propflyer_id','id')
->whereNull('xLastDeliveryDate')
->where('propflyers.propagent_id','=',"$umid")
->doesntHave('currentCamps')
->with(['thePhotos'=>function($q){
   $q->select('propflyer_id','photoName','def')
   ->where('def','=','1')
   ->where('resized','=','500');
}])
->with(['theMeta'=>function($q){
   $q->select('propflyer_id','zipDir','mlsDir','sk1');
}])
->orderBy('creationDate','desc');

$activeCount=$activeCampaigns->count();
$completeCount=$completeCampaigns->count();
$unsentCount=$unsentFlyers->count();
$totalCampaignCount=$activeCount+$completeCount;

//get id for single record
if($activeCount){
	$id=$activeCampaigns->first()->id;}
if($completeCount){
	$id=$completeCampaigns->first()->id;}