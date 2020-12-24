<?php

Use App\autosynch\models\propagent\propagentOld;

//logo
$agentlogoQuery=propagentOld::whereNull('agtLogoCheck')
->select('logo','officeID','umid')
->whereNotNull('logo')
->where('logo','!=','logosample.gif')
->orWhere(function($q){
   $q->whereRaw('last_login > agtLogoCheck')
   ->whereNotNull('logo')
   ->where('logo','!=','logosample.gif');
});

//count
$totalRecords=$agentlogoQuery->count();

//log complete if done
if($totalRecords<1){
	include(app_path().'/autosynch/log/completeLog.php');}

//loop
$agentlogoQuery=$agentlogoQuery
->take(1)
->get();