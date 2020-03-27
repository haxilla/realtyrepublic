<?php

Use App\models\core\propagent;
Use App\models\core\propflyer;

if(!Auth()->guard('member')){
	dd('error-line4-app/accountVariables/accountInfo');}

$umid=auth()->guard('member')->user()->id;

$agentInfo=propagent::select(
   'remCreds','expireDate','accountType','agtReview','id',
   'agtFirst','agtLast','agtDesigs','agtMainPhone','agtEmail',
   'agtWebsite','agtPhoto','agtLogo','officeID','trialPswd',
   'passHash','agtWebsite','created_at','startDate')
->with(['theAgentMeta'=>function($q){
$q->select('propagent_id','newRemID');
}])
->where('id','=',"$umid")
->first();

$accountInfo=propagent::select('officeID','agtPhoto','agtFullName',
   'agtState','agtReview','accountType','remCreds','expireDate',
   'agtEmail')
->where('id','=',"$umid")
->first();

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
}])
->get();

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
->orderBy('xLastDeliveryDate','desc')
->simplepaginate(5);

//default value
$changePswd=0;
//check current
$trialPassword=$agentInfo['trialPswd'];
//compare
$passHash=$agentInfo['passHash'];
//force change if needed
if(Hash::check($trialPassword,$passHash)){
   $changePswd=1;}