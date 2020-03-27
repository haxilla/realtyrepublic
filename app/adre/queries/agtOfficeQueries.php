<?php
//models
Use App\models\core\agtoffice;

//lastClears
$agentClearListQuery=agtoffice::whereNotNull('agentClear')
->where('agentConfirmDelete','!=','1')
->select('propagent_id','officeName')
->with(['theAgent'=>function($q){
   $q->select('id','agtFullName','accountType','xxAgtUname',
      'agtEmail','lastLogin');
}])
->orderBy('agentClear','desc')
->take(5)
->get();

//lastDeletes
$agentDeleteListQuery=agtoffice::whereNotNull('agentClear')
->where('agentConfirmDelete','=','1')
->select('propagent_id','officeName','agentDeleteReason')
->with(['theAgent'=>function($q){
   $q->select('id','agtFullName','accountType','xxAgtUname',
      'agtEmail','lastLogin');
}])
->orderBy('agentClear','desc')
->take(5)
->get();
