<?php

use App\autosynch\models\propagent\propagentOld;

//photo
$agentphotoQuery=propagentOld::select('agentPhoto','umid','officeID','newRemID')
->whereNull('agtPhotoCheck')
->whereNotNull('agentPhoto')
->whereNotNull('newRemID')
->whereNotNull('officeID')
->where('agentPhoto','!=','agentSample.gif')
->orWhere(function($q){
   $q->whereRaw('last_login > agtPhotoCheck')
   ->whereNotNull('agentPhoto')
   ->where('agentPhoto','!=','agentSample.gif');
});

//count
$totalRecords=$agentphotoQuery->count();

//log complete if done
if($totalRecords<1){
	include(app_path().'/autosynch/log/completeLog.php');}

//loop
$agentphotoQuery=$agentphotoQuery
->take(1)
->get();
