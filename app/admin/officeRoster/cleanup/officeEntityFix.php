<?php
//models
Use App\models\core\agtoffice;
Use App\models\core\propoffice;
Use App\models\core\propagentmeta;
Use App\models\adre\adreEntity;
Use App\models\oldsite\oldAgent;
//query
$entityFix=propagentmeta::select('propagent_id','EmployerLicNumber')
->whereNotNull('EmployerLicNumber')
->whereNull('officeFixDate');
//count
$entityFixCount=$entityFix->count();
//closure
$entityFixLoop=$entityFix
->take(1)
->get();
//loop
if($entityFixLoop->count()>0){
   //foreach
   foreach($entityFixLoop as $the){
      //set var
      $thisELN    = $the->EmployerLicNumber;
      $thisAgent  = $the->propagent_id;
      $now        = \Carbon\Carbon::now();
      //query entity
      $adreEntity=adreEntity::where('LicNumber','=',"$thisELN")
      ->first();
      //error if none
      if(!$adreEntity){
         dd('error-line27-officeEntityFix');}
      //variables
      $theOfficeAddress1   = $adreEntity['Address1'];
      $theOfficeAddress2   = $adreEntity['Address2'];
      $theOfficeCity       = $adreEntity['City'];
      $theOfficeState      = $adreEntity['State'];
      $theOfficeZip        = $adreEntity['Zip'];
      $theOfficeDBA        = $adreEntity['DBAName'];
      $theOfficeLegal      = $adreEntity['LegalName'];
      $theOfficeBroker     = $adreEntity['DesignatedBrokerLicNumber'];
      //officeName
      $officeName=$theOfficeDBA;
      //if no DBA Use Legal
      if(!$officeName){
         $officeName=$theOfficeLegal;}
      //update agtOffice
      $check=agtoffice::where('propagent_id','=',"$thisAgent")
      ->update([
         'officeName'         => $officeName,
         'officeAddress1'     => $theOfficeAddress1,
         'officeAddress2'     => $theOfficeAddress2,
         'officeCity'         => $theOfficeCity,
         'officeState'        => $theOfficeState,
         'officeZip'          => $theOfficeZip,
         'EmployerLicNumber'  => $thisELN,]);
      //propoffice
      propoffice::where('EmployerLicNumber','=',"$thisELN")
      ->update([
         'officeName'      => $officeName,
         'officeDBAName'   => $theOfficeDBA,
         'officeLegal'     => $theOfficeLegal,
         'officeAddress1'  => $theOfficeAddress1,
         'officeAddress2'  => $theOfficeAddress2,
         'officeCity'      => $theOfficeCity,
         'officeState'     => $theOfficeState,
         'officeZip'       => $theOfficeZip,
         'DesignatedBrokerLicNumber'  => $theOfficeBroker,]);

      //update meta
      propagentmeta::where('propagent_id','=',"$thisAgent")
      ->update([
         'officeFixDate'=>$now,]);

      //update RealtyEmails
      oldAgent::where('umid','=',"$thisAgent")
      ->update([
         'xOfficeID'=>$thisELN,]);}
      //end for each loop
   //json values
   $idArray = array(
     'status'        => 'success',
     'thisELN'       => $thisELN,
     'thisAgent'     => $thisAgent,
     'totalCount'    => $entityFixCount,);

   //output & exit
   echo json_encode($idArray);
   exit();
}




