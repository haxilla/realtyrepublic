<?php
Use App\models\core\propagent;
//set default
$emailNotes=null;
//run loop
foreach($dupCheck as $dup){
   //gather accountIds
   //set defaults
   $thisAgentEmail=null;
   $thisAgtUname=null;
   $thisxXagtUname=null;
   $getAgent1=propagent::where('id','=',"$dup")
   ->select('agtEmail','xxAgtUname','agtUname')
   ->first();
   //set vars
   $thisAgtEmail     = $getAgent1['agtEmail'];
   $thisAgtUname     = $getAgent1['agtUname'];
   $thisXxAgtUname   = $getAgent1['xxAgtUname'];
   //agtEmail
   if($thisAgtEmail != $mainAccountQuery['agtEmail']
   && $thisAgtEmail != $mainAccountQuery['xxAgtUname']
   && $thisAgtEmail != $mainAccountQuery['agtUname']){
      $theAgtEmail=$thisAgtEmail;
      $emailNotes[]= $theAgtEmail;}
   //agtUname
   if($thisAgtUname != $mainAccountQuery['agtEmail']
   && $thisAgtUname != $mainAccountQuery['xxAgtUname']
   && $thisAgtUname != $mainAccountQuery['agtUname']){
      $theAgtUname=$thisAgtUname;
      $emailNotes[]= $theAgtUname;}
   //xxAgtUname
   if($thisXxAgtUname != $mainAccountQuery['agtEmail']
   && $thisXxAgtUname != $mainAccountQuery['xxAgtUname']
   && $thisXxAgtUname != $mainAccountQuery['agtUname']){
      $theXxAgtUname=$thisXxAgtUname;
      $emailNotes[] = $theXxAgtUname;}}

$remailEventLog['accountsMoved']['emailNotes']=$emailNotes;
