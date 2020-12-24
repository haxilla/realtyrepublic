<?php

//models
use App\models\core\propagent;
//propagent
$propagentLoop=propagent::select('id','agtFullName','startDate',
   'expireDate','xxAgtUname','accountType','agtEmail')
->where(function($q)
   use($adreAgentFirst3,$adreAgentLast3,
   $adreAgentLastClean,$propagent_id){
      $q->where('agtFullName','LIKE','%'.$adreAgentFirst3.'%')
         ->where('agtFullName','LIKE','%'.$adreAgentLast3.'%')
         ->orWhere('agtFullName','LIKE','%'.$adreAgentLastClean.'%')
         ->orWhere('id','=',"$propagent_id");
})
->wheredoesnthave('theAgentCleanup',function($q){
   $q->whereNotNull('accountType');
})
->with(['theAgtOffice'=>function($q){
   $q->select('officeName','propagent_id');
}])
->get();
//lastLogin
$lastLoginAgentQuery=propagent::whereHas('theAgentCleanup',
   function($q){
      $q->whereNull('accountType');
   })
->select('id','agtFullName','accountType','xxAgtUname','agtEmail','lastLogin')
->with(['theAgtOffice'=>function($q){
   $q->select('officeName','propagent_id');
}])
->orderBy('lastLogin','desc')
->take(10)
->get();

