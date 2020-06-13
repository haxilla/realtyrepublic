<?php

// **   PAST ALL ERRORS
// **   SUCCESS PROCESS
if($deleteThis==1){
   //delete process
   include(app_path().'/adre/sql/delete/confirmDeleteLoop.php');
   include(app_path().'/adre/sql/create/createPropAgentMeta.php');

}else{
   //run through merge accounts
   if(array_key_exists('mergeAccount', $remailEventLog['allAccounts'])){
      //foreach mergeAccount
      foreach($remailEventLog['allAccounts']['mergeAccount'] as $the){
         //variables
         include(app_path().'/adre/variables/mergeAccountVariables.php');
         //if flyers, move
         include(app_path().'/adre/functions/moveFlyers.php');
         //if credits, move
         include(app_path().'/adre/functions/moveCredits.php');
         //mark propagentcleanup with accountType,etc
         include(app_path().'/adre/sql/update/propagentCleanup.php');
         //mark deleted
         include(app_path().'/adre/sql/delete/confirmDelete.php');}}
      //end of MERGE foreach loop
    //end of If MergeAccount

   //current account variables
   include(app_path().'/adre/variables/currentAccountVariables.php');
   //final variables (use summary)
   include(app_path().'/adre/variables/finalVariables.php');
   //compare startDate
   include(app_path().'/adre/sql/compare/startDate.php');
   //compare expireDate
   include(app_path().'/adre/sql/compare/expireDate.php');
   //compare expireDate
   include(app_path().'/adre/sql/compare/xxAgtUname.php');
   //compare agtPhoto
   include(app_path().'/adre/sql/compare/agtPhoto.php');
   //compare agtLogo
   include(app_path().'/adre/sql/compare/agtLogo.php');
   //create propAgentMeta for mainID
   include(app_path().'/adre/sql/create/createPropAgentMeta.php');}
//end of if/else (deleteThis)

//set agtClear
include(app_path().'/adre/sql/update/agentClear.php');
//mergeLog
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['status']['agentClear']=$now;
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['status']['adminID']=$adminID;
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['status']['newRemID']=$newRemID;

