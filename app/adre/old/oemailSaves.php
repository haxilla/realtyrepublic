<?php
//set defaults
$theAgtEmail=null;
$theAgtUname=null;
$xxAgtUname=null;
//start array
$i=0;
$emailSave=array();
$emailSaves[$i] = [];
foreach($dupCheck as $thisDup){
   //increment
   $i++;
   //set thePropagentID
      $thePropagentID=$thisDup;

   //agtEmail
      if($the['agtEmail'] != $mostFlyersAccountQuery['agtEmail']
      && $the['agtEmail'] != $mostFlyersAccountQuery['xxAgtUname']
      && $the['agtEmail'] != $mostFlyersAccountQuery['agtUname']){
         $theAgtEmail=$the['agtEmail'];}
      //emailSaves
      $emailSaves[$i]['emailNote1']    = $theAgtEmail;
      $emailSaves[$i]['propagent_id']  = $thePropagentID;

   //agtUname
      if($the['agtUname'] != $mostFlyersAccountQuery['agtEmail']
      && $the['agtUname'] != $mostFlyersAccountQuery['xxAgtUname']
      && $the['agtUname'] != $mostFlyersAccountQuery['agtUname']){
         $theAgtUname=$the['agtUname'];}
      //emailSaves
      $emailSaves[$i]['emailNote2']    = $theAgtUname;
      $emailSaves[$i]['propagent_id']  = $thePropagentID;

   //xxAgtUname
      if($the['xxAgtUname'] != $mostFlyersAccountQuery['agtEmail']
      && $the['xxAgtUname'] != $mostFlyersAccountQuery['xxAgtUname']
      && $the['xxAgtUname'] != $mostFlyersAccountQuery['agtUname']){
         $xxAgtUname=$the['xxAgtUname'];}
      //emailSaves
      $emailSaves[$i]['emailNote3']    = $xxAgtUname;
      $emailSaves[$i]['propagent_id']  = $thePropagentID;
}

