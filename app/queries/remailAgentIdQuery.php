<?php
//model
use App\models\core\agtoffice;
//query
//use officeID to search for match
$first5=substr($remailAgentID, 0,5); //address
$last5=substr($remailAgentID, -5); //address

$remailAgentIdQuery=agtoffice::where('remailAgentID','=',"$remailAgentID")
->select('tempOfficeID','propagent_id','officeName','officeAddress1',
  'officeCity','officeState','officeZip','armlsOfficeID','agentClear',
  'agentFlag','agentConfirmDelete','remailAgentID')
->with(['theAgent'=>function($q){
   $q->select('agtFullName','lastLogin','id','startDate','expireDate','remCreds',
    'accountType','officeID','agtCity','agtState','agtZip','xxAgtUname')
   ->with(['theFlyer'=>function($q){
      $q->select('id','propagent_id');
   }]);
}])
->orderBy('updated_at','desc')
->get();
//extra searches


//first5
$remailAgentIdFirst5=agtoffice::where(
   'remailAgentID','like',$first5.'%')
->select('tempOfficeID','propagent_id','officeName','officeAddress1',
  'officeCity','officeState','officeZip','armlsOfficeID','agentClear',
  'agentFlag','agentConfirmDelete','remailAgentID',\DB::raw('count(*) as total'))
->with(['theAgent'=>function($q){
   $q->select('agtFullName','lastLogin','id','startDate','expireDate','remCreds',
    'accountType','officeID','agtCity','agtState','agtZip','xxAgtUname')
   ->with(['theFlyer'=>function($q){
      $q->select('id','propagent_id');
   }]);
}])
->orderBy('updated_at','desc')
->groupBy('officeName')
->get();

//last 5
$remailAgentIdLast5=agtoffice::where(
   'remailAgentID','like','%'.$last5)
->select('tempOfficeID','propagent_id','officeName','officeAddress1',
  'officeCity','officeState','officeZip','armlsOfficeID','agentClear',
  'agentFlag','agentConfirmDelete','remailAgentID')
->with(['theAgent'=>function($q){
   $q->select('agtFullName','lastLogin','id','startDate','expireDate','remCreds',
    'accountType','officeID','agtCity','agtState','agtZip','xxAgtUname')
   ->with(['theFlyer'=>function($q){
      $q->select('id','propagent_id');
   }]);
}])
->orderBy('updated_at','desc')
->get();


