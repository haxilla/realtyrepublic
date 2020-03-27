<?php
Use App\models\core\agtoffice;
//Office Data
$thisAgentIdRecord=agtoffice::select('propagent_id','armlsOfficeID',
   'tempOfficeID','officeID','officeAddress1','agentClear',
   'agentFlag','agentConfirmDelete')
->with(['theAgent'=>function($q2){
   $q2->select('id','agtFullName','remCreds','startDate',
   'expireDate','accountType','lastLogin','accountType',
   'agtCity','agtState','agtZip','agtMainPhone');
}])
->where('propagent_id','=',"$umid")
->get();
