<?php
//model
use App\models\core\agtoffice;
//update
agtoffice::where('propagent_id','=',"$thePropAgentID")
->update([
   'agentConfirmDelete'    =>1,
   'officeConfirmDelete'   =>1,
   'agentDeleteReason'     =>'merged',
   'officeDeleteReason'    =>'merged',
   'mergedWith'            => $mainAccountID,
]);
