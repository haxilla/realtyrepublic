<?php

Use App\models\core\propagent;
Use App\models\core\propflyer;
Use Auth;
Use Hash;

//set umid
$umid=Auth::guard('member')->user()->id;

//agentInfo
$agentInfo=propagent::select(
   'remCreds','expireDate','accountType','agtReview','id','agtState',
   'agtFirst','agtLast','agtFullName','agtDesigs','agtMainPhone','agtEmail',
   'agtWebsite','agtPhoto','agtLogo','officeID','trialPswd','agtReview',
   'passHash','agtWebsite','created_at','startDate','officeID')
->with(['theAgentMeta'=>function($q){
   $q->select('propagent_id','newRemID');
}])
->with(['theAgtOffice'=>function($q){
   $q->select('propagent_id','officeName','officeAddress1','officeCity',
   'officeState','officeZip');
}])
->with(['theFlyer'=>function($q){
   $q->select('propagent_id','id');
}])
->where('id','=',"$umid")
->first();

//activeCampaigns
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

//completeCampaigns
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

//unsentFlyers
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

//counts
$activeCount=$activeCampaigns->count();
$completeCount=$completeCampaigns->count();
$unsentCount=$unsentFlyers->count();
$totalCampaignCount=$activeCount+$completeCount;

//queries


//force password change logic
$changePswd=0;
//check current
$trialPassword=$agentInfo['trialPswd'];
//compare
$passHash=$agentInfo['passHash'];
//force change if needed
if(Hash::check($trialPassword,$passHash)){
   $changePswd=1;}