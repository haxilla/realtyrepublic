<?php
//dupCheck from controller
$dupCheck=request('dupCheck');
//error if none
if(!$dupCheck){
   dd('error-line159-rosterSearchController');}

//defaults set to zero and overwritten by script if found
include('accountQueries/primaryVariables.php');
//run loop
include('thisAccount/dupCheckLoop.php');
//must be run AFTER dupcheck loop
//queries on mostFlyers,earliestAccount,mainAccount
include('accountQueries/masterList.php');
//get account details into log
$remailEventLog['accountDetails']=$thisAccount;
//emailNotes
include('moves/emailNotes.php');
include('moves/accountIdsMoved.php');
//AccountConflict
if($creditAccount && $unlimitedAccount){
   include('remchecks/accountConflict.php');}
//flyerMoveCount
if($flyerMoveCount){
   include('moves/flyerMoves.php');}
//photoChecks
//returns remoteAgentFound, localAgentFound
include('remchecks/checkAgtPhoto.php');
//returns remoteLogoFound, logoLogoFound
include('remchecks/checkAgtLogo.php');
//if file exists local and remote
if($localAgtFound==1 && $localLogoFound==1){
   include('remchecks/imagesOK.php');
}else{
   include('remchecks/imagesNotOK.php');}
//if mainAccount(xxAgtUname) !== lastLogin(xxAgtUname)
if($mainAccountQuery['xxAgtUname'] !=
   $lastLoginAccountQuery['xxAgtUname']){
      include('remchecks/checkXxAgtUname.php');}
//startDate
if($mainAccountQuery['startDate'] > $earliestAccountQuery['startDate']){
   include('remchecks/changeStartDate.php');}

//check agtUname and add if not there
if(!$mainAccountQuery['agtUname']){
   include('remChecks/checkAgtUname.php');}

//creates file and puts in agent account
include(app_path().'/functions/json/create_JsonLogFile.php');
//$remailEventLog=json_encode($remailEventLog);
$remailEventLog=json_encode($remailEventLog);

/*
$html=View::make('mdbxAdmin.adre.partials.mergeReport')
   ->with(compact('remailEventLog'))->render();

