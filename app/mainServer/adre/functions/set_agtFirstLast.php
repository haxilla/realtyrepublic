<?php
//models
use App\models\core\propagent;
use App\models\oldsite\oldAgent;
//split
$pieces = explode(" ",$agtFullName);
//label name & host
if(isset($pieces[0]) && isset($pieces[1])){
   //set vars
   $agtFirstName  = trim($pieces[0]);
   $agtLastName   = trim($pieces[1]);
   //propagent
   propagent::where('id','=',"$nextRecord")
   ->update([
      'agtFirst'  => $agtFirstName,
      'agtLast'   => $agtLastName,]);
   //update on oldsite
   oldAgent::where('umid','=',"$nextRecord")
   ->update([
      'agentFirst'=>$agtFirstName,
      'agentLast'=>$agtLastName,
   ]);}else{
      dd($agtFullName,$agtFirstName,$agtLastName,'error-line23-set_agtFirstLast');}
