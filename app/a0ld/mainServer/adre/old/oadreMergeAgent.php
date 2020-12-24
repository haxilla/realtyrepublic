<?php
//dupCheck from controller
$dupCheck=request('dupCheck');
//error if none
if(!$dupCheck){
   dd('error-line159-rosterSearchController');}

//defaults set to zero and overwritten by script if found
include('primaryVariables.php');
//run loop
include('dupCheckLoop.php');
//must be run AFTER dupcheck loop
//queries on mostFlyers,earliestAccount,mainAccount
include('accountQueries/masterList.php');
//photoChecks
//returns remoteAgentFound, localAgentFound
include('remchecks/checkAgtPhoto.php');
//returns remoteLogoFound, logoLogoFound
include('remchecks/checkOfficeLogo.php');
//if file exists local and remote
if($localAgtFound==1 && $localLogoFound==1){
   include('remchecks/imagesOK.php');}
if()
//Builds list of accountIdsMoved
include('arrays/accountIdsMoved.php');
//start mergerNotes
include('mergerNotes/startMergerNotes.php');
//run accountDetailsLoop
include('accountDetailsLoop.php');
//emailNamesMoved
include('arrays/emailNamesMoved.php');

//check agtUname and add if not there
if(!$mainAccountQuery['agtUname']){
   include('sql/updateAgtUname.php');}
//mark verified
include('sql/accountVerified.php');
//mergerNotes
include('sql/mergerNoteSQL.php');
