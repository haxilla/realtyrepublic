<?php
//model
use App\models\core\agtoffice;
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\adre\adreAgent;
//setup to run min function
$allAccountsArr = array($dupLoop['allAccounts']);
//earliest AccountId
if($deleteThis==1){
   //code below gets smallest number from arraykey of accountIds
   $mainAccountID = min(array_keys($allAccountsArr[0]));}
else{
   //compare and find mainAccountID
   $mainAccountID=$lastLoginAccount;
   if(!$mainAccountID){
      $mainAccountID=$mostFlyersAccount;}
   if(!$mainAccountID){
      $mainAccountID=$mostRemCredsAccount;}
   if(!$mainAccountID){
      $mainAccountID=$latestAccount;}
   if(!$mainAccountID){
      $mainAccountID=$earliestAccount;}
   if(!$mainAccountID){
      //code below gets smallest number from arraykey of accountIds
      $mainAccountID = min(array_keys($allAccountsArr[0]));}

   //log last/most accounts
   include(app_path().'/adre/accountQueries/accountReport.php');}


//adds the "main=1" tag to mainAccountID
$dupLoop['allAccounts'][$mainAccountID]['details']['main']=1;
//mainAccountQuery
$mainAccountQuery=propagent::where('id','=',"$mainAccountID")
->select('agtUname','xxAgtUname','agtEmail')
->first();
//mainOffice query
$mainOfficeQuery=agtoffice::where('propagent_id','=',"$mainAccountID")
->select('remailAgentID','tempOfficeID','newRemID','officeName',
   'officeAddress1','officeAddress2','officeCity','officeState','officeZip',
   'propagent_id','officeID')
->first();

//propAgentMetaQuery
$propAgentMetaQuery=propagentmeta::select('propagent_id')
->where('LicNumber','=',"$LicNumber")
->first();
//query LicStatus
$adreStatusQuery=adreAgent::where('LicNumber','=',"$LicNumber")
->select('LicStatus');
//set LicStatus
$thisLicStatus=$adreStatusQuery->first()->LicStatus;
//used in functions/deleteSuccessProcess
$mainRemailAgentID=$mainOfficeQuery['remailAgentID'];
$mainOldOfficeID=$mainOfficeQuery['officeID'];
//mainNewRemID
$mainNewRemID=$mainOfficeQuery['newRemID'];
   //create the newRemID if none
   if(!$mainNewRemID){
      $mainNewRemID=$newRemID;
      agtoffice::where('propagent_id','=',"$mainAccountID")
      ->update([
         'newRemID'=>$newRemID
      ]);}
//mainTempOfficeID
$mainTempOfficeID=$mainOfficeQuery['tempOfficeID'];
if(!$mainTempOfficeID){
   //run script to create Ids
   include(app_path().'/synch/set_tempOfficeID.php');
   //re-query for new value
   $mainTempOfficeID=agtoffice::where('propagent_id','=',"$mainAccountID")
   ->pluck('tempOfficeID')
   ->first();
   //error if none
   if(!$mainTempOfficeID){
      dd('error-line77-setMainIDs');}}

//emailSaves StarterEmail
$emailSaves=null;
$emailSaves=$mainAccountQuery['agtEmail'];
if(!$emailSaves){
$emailSaves=$mainAccountQuery['xxAgtUname'];}
$dupLoop['allAccounts'][$thisID]['details']['agtFullName'] = $thisAgtFullName;
