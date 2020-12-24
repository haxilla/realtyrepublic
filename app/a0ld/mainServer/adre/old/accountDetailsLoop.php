<?php
//set increment
$i=0;
//accountDetails Loop
foreach($accountDetails as $the){
   $i++;
   // if remCreds but not main account
   if($the['remCreds'] && $the['propagent_id'] != $mainAccountID){
      include('remchecks/moveRemCreds.php');}
   // if flyers but not main account
   if($the['flyerCount'] > 0 && $the['propagent_id'] != $mainAccountID){
      include('remchecks/moveFlyers.php');}
   // if agtEmail,agtUname,or xxAgtUname, save
   include('arrays/emailSaves.php');
   // if not main account
   if($the['propagent_id'] != $mainAccountID){
      //set thePropAgentID
      $thePropAgentID=$the['propagent_id'];
      //trash thePropAgentID in agtOffice
      include('sql/trashOldAccounts.php');}}
      //end foreach Loop(accountDetails)
