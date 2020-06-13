<?php
use App\models\admin\photoError;
$agtLogoNotes=[];
if($getAgent['agtLogo'] && $getAgent['agtLogo'] != 'logosample.gif'){
   //set & log
   $agtLogoError=0;
   $hasAgtLogo=1;
   $agtLogo=$getAgent['agtLogo'];
   $images[$thisID]['agtlogo']=$agtLogo;
   //does it exist
   include(app_path().'/adre/remchecks/checkAgtLogo.php');
   //if none set error
   if(!$localAgtLogoFound && !$remoteAgtLogoFound){
      $agtLogoNotes['logoError'][]=$thisDup;
      $agtLogoError=1;}
}else{
   $agtLogoNotes['noLogo'][]=$thisDup;
   $localAgtLogoFound=0;
   $remoteAgtLogoFound=0;
}

if($agtLogoError && $sqlOK==1){
   photoError::create([
      'propagent_id' => $thisDup,
      'photoURL'     => $remoteAgtLogoURL,
   ]);}

