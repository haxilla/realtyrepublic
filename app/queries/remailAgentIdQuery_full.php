<?php
use App\models\core\agtoffice;
//get this Record
$getRecord=agtoffice::where('propagent_id','=',"$umid")
->select('remailAgentID','propagent_id')
->first();
//get remailAgentID
$remailAgentID=$getRecord['remailAgentID'];
//error if none
if(!$remailAgentID){
   include(app_path().'/synch/set_remailAgentID.php');
   //get remailAgentID
   $remailAgentID=$thisRecord['remailAgentID'];}

if(!$remailAgentID){
   dd('line25-agentSingleRecord.php');}
//run query
include(app_path().'/queries/remailAgentIdQuery.php');
