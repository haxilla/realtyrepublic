<?php
/* Used to synch changes made BEFORE live updates */
/*                NOT IN USE                      */

Use App\models\core\agtoffice;
use App\models\oldsite\oldAgent;

$getCleared=agtoffice::whereNotNull('agentClear')
->select('propagent_id','EmployerLicNumber','agentConfirmDelete','agentClear')
->get();

foreach($getCleared as $the){
   //set variables
   $theID=$the['propagent_id'];
   $theELN=$the['EmployerLicNumber'];
   $theAgentConfirmDelete=$the['agentConfirmDelete'];
   $theAgentClear=$the['agentClear'];
   //oldAgent
   oldAgent::where('umid','=',"$theID")
   ->update([
      'xOfficeID'     => $theELN,
      'confirmDelete' => $theAgentConfirmDelete,
      'agentClear'    => $theAgentClear,
   ]);}
