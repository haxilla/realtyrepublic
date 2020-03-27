<?php
Use App\models\core\agtoffice;
//Office Data
$thisAgentIdRecord=agtoffice::select('officeID','officeName','officeAddress1',
   'officeCity','officeState','officeZip','armlsOfficeID')
->with(['theAgtOffice'=>function($q){
   $q->select('propagent_id','armlsOfficeID','tempOfficeID','officeID',
      'officeAddress1','agentClear','agentFlag','confirmDelete')
      ->with(['theAgent'=>function($q2){
         $q2->select('id','agtFullName','remCreds','startDate',
         'expireDate','accountType','lastLogin','accountType',
         'agtCity','agtState','agtZip','agtMainPhone');
      }]);
}])
->where('propagent_id','=',"$umid")
->get();
