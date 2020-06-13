<?php
if(isset($adreEntity)){
   //mainLog
   $adreEntityLog[$mainAccountID]['officeExists']=$officeExists;
   $adreEntityLog[$mainAccountID]['officeAdded']=$officeAdded;
   $adreEntityLog[$mainAccountID]['EmployerLicNumber']=$EmployerLicNumber;
   $adreEntityLog[$mainAccountID]['OfficeName']=$adreEntity['DBAName'];
   $adreEntityLog[$mainAccountID]['Address1']=$adreEntity['Address1'];
   $adreEntityLog[$mainAccountID]['Address2']=$adreEntity['Address2'];
   $adreEntityLog[$mainAccountID]['City']=$adreEntity['City'];
   $adreEntityLog[$mainAccountID]['State']=$adreEntity['State'];
   $adreEntityLog[$mainAccountID]['Zip']=$adreEntity['Zip'];
   $adreEntityLog[$mainAccountID]['Phone']=$adreEntity['Phone'];
   $adreEntityLog[$mainAccountID]['County']=$adreEntity['County'];
   $adreEntityLog[$mainAccountID]['DBLicNumber']=$adreEntity['DesignatedBrokerLicNumber'];
   $adreEntityLog[$mainAccountID]['officeMemberCount']=$officeMemberCount;
   $adreEntityLog[$mainAccountID]['officeMemberCheck']=$officeMemberCheck;
}else{
   $adreEntityLog[$mainAccountID]['EmployerLicNumber']='none';
}

//merge into remailEventLog
$remailEventLog['allAccounts']['mainAccount'][$mainAccountID]['adreEntity']=$adreEntityLog[$mainAccountID];
