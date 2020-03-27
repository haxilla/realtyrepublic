<?php

use App\models\oldsite\oldAgent;
//photo
$photoCheckQuery=oldAgent::select('agentPhoto','umid','officeID')
->whereNull('agtPhotoCheck')
->whereNotNull('agentPhoto')
->where('agentPhoto','!=','agentSample.gif')
->orWhere(function($q){
   $q->whereRaw('last_login > agtPhotoCheck')
   ->whereNotNull('agentPhoto')
   ->where('agentPhoto','!=','agentSample.gif');
});
$photoCheckCount=$photoCheckQuery->count();
$photoCheckQuery=$photoCheckQuery
->take(1)
->get();
//logo
$logoCheckQuery=oldAgent::whereNull('agtLogoCheck')
->select('logo','officeID','umid')
->whereNotNull('logo')
->where('logo','!=','logosample.gif')
->orWhere(function($q){
   $q->whereRaw('last_login > agtLogoCheck')
   ->whereNotNull('logo')
   ->where('logo','!=','logosample.gif');
});
$logoCheckCount=$logoCheckQuery->count();
$logoCheckQuery=$logoCheckQuery
->take(1)
->get();
