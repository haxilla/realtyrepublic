<?php
use App\models\core\propagent;
//get Agents
$getAgents=propagent::where('id','like','%'.$formVal.'%')
->orWhere('agtFullName','like','%'.$formVal.'%')
->orWhere('agtFirst','like','%'.$formVal.'%')
->orWhere('agtLast','like','%'.$formVal.'%')
->select('agtFullName','id','accountType')
->with(['theAgentCleanup'=>function($q){
   $q->select('accountType','propagent_id');
}])
->with(['theFlyer'=>function($q){
   $q->select('id','propagent_id');
}])
->take(15)
->get();
// create view
$html=View::make('mdbxAdmin.autosearch.propagentResults')
->with([
   'getAgents'     => $getAgents,
])->render();
//show
echo $html;
