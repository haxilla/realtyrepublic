<?php
//models
use App\models\core\propoffice;
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\adre\adreEntity;
//  set vars
$adreEntityLog=[];
$officeExists=0;
$officeAdded=0;

// if it has EmployerLicNumber check it
if($EmployerLicNumber){
   //query
   $officeMemberQuery=agtoffice::select('propagent_id')
   ->where('tempOfficeID','=',"$mainTempOfficeID");
   //count
   $officeMemberCount=$officeMemberQuery->count();
   //left to check
   $officeMemberCheck=$officeMemberQuery->whereNull('agentClear')->count();
   //adreEntity
   $adreEntity=adreEntity::where('LicNumber','=',"$EmployerLicNumber")
   ->select('DBAName','LegalName','Address1','Address2','City','State','Zip','County',
      'Phone','DesignatedBrokerLicNumber')
   ->first();
   //propofficeQuery
   $propOfficeQuery=propoffice::where(
      'EmployerLicNumber','=',"$EmployerLicNumber")
   ->select('officeID');
   //if office Exists NOTHING is done
   if($propOfficeQuery->count()){
      //updates mainTempOfficeID matches
      include(app_path().'/adre/sql/update/agtOfficeUpdate.php');
      //officeExists
      $officeExists=1;}

   //if sqlOK - add
   elseif($sqlOK==1){
      //change officeID
      agtoffice::where('propagent_id','=',"$mainAccountID")
      ->update([
         'officeID'=>$EmployerLicNumber,]);
      //start record over
      propoffice::destroy($mainTempOfficeID);
      //create the record in propoffice
      include(app_path().'/adre/sql/create/createAdreEntity.php');

      //mark as added
      $officeExists=1;
      $officeAdded=1;}}

//Logging & merging into remailEventLog
include(app_path().'/adre/logs/adreEntityLog.php');
