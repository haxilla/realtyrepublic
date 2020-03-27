<?php

//get this Record
$thisRecord=agtoffice::where('propagent_id','=',"$umid")
->select('remailAgentID','propagent_id')
->get()
->first();
//get remailAgentID
$remailAgentID=$thisRecord['remailAgentID'];
//error if none
if(!$remailAgentID){
   include(app_path().'/synch/set_remailAgentID.php');
   //get remailAgentID
   $remailAgentID=$thisRecord['remailAgentID'];}

if(!$remailAgentID){
   dd('line25-agentSingleRecord.php');}
//run query
include(app_path().'/queries/remailAgentIdQuery.php');
