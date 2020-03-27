<?php
//models
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\core\propoffice;
use App\models\core\agtoffice;
use App\models\rets\glvarOffice;
use App\models\dev\masterVersion;

$agtPswd    = str_random(10);
$passHash   = bcrypt($agtPswd);
$microVersion=masterVersion::orderBy('id','desc')
->pluck('microVersion')
->first();
//get agentPhoto - first object only
if($listName=='glvar'){
   include(app_path().'/mdbxTrial/glvar/retsAgtPhoto');}

//create account
$newAgent=propagent::create([
   'agtFirst'        => $agtFirst,
   'agtLast'         => $agtLast,
   'agtType'         => $agtType,
   'agtFullName'     => $agtFullName,
   'agtMainPhone'    => $agtMainPhone,
   'agtHomePhone'    => $agtHomePhone,
   'agtMobile'       => $agtMobile,
   'officeID'        => $officeID,
   'agtCounty'       => $agtCounty,
   'agtBoard'        => $agtBoard,
   'agtWebsite'      => $agtWebsite,
   'accountType'     => $accountType,
   'agtUname'        => $theEmail,
   'agtEmail'        => $theEmail,
   'trialPswd'       => $agtPswd,
   'passHash'        => $passHash,
   'eidx'            => $eidx,
   'microVersion'    => $microVersion,
   'agtReview'       => 1,
   'autoTrialDate'   => $autoTrialDate,
   'cbpAmt'          => $cbpAmt,
   'cbpDate'         => $cbpDate,
   'agtPhoto'        => $fileName,
   'agtPhotoHeight'  => $cHeight,
   'agtPhotoWidth'   => $cWidth,
   'agtPhotoOrient'  => $orient,
   'agtPhotoRatio'   => $ratio,
   'agtPhotoFileSize'=> $newFileSize,
]);
//get UMID
$umid=$newAgent->id;
//propagentmeta
propagentmeta::create([
   'propagent_id'       => $umid,
   'matrixID'           => $matrixID,
   'newRemID'           => $newRemID,
   'agtPhotoUploadDate' => \Carbon\Carbon::now(),
   'hasAgtPhoto'        => $hasAgtPhoto,
   'licNumber'          => $licenseNumber,
   'licStatus'          => $licenseStatus,
   'agtType'            => $agtType,
   'eidx'               => $eidx,
]);
//propagentmeta
propagentcleanup::create([
   'propagent_id'       => $umid,
   'matrixID'           => $matrixID,
   'newRemID'           => $newRemID,
   'licNumber'          => $licenseNumber,
   'agtType'            => $agtType,
]);
//insert office
agtoffice::create([
   'eidx'            => $eidx,
   'newRemID'        => $newRemID,   
   'propagent_id'    => $umid,
   'officeID'        => $officeID,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'officePhone'     => $officePhone,
]);
//propoffice query - check if exists 
$officeCheck=propoffice::where('officeID','=',$glvarOfficeID)
->first();
//if not- create
if(!$officeCheck){
   //load officeInfo
   $retsOffice=glvarOffice::where('MLSID','=',$officeID)
   ->first();
   //error if none
   if(!$retsOffice){
      dd('error-line138-GLVAR_importListing',$officeID);}
   //add new office
   propoffice::create([
      'officeID'           => $glvarOfficeID,
      'tempOfficeID'       => $officeID,
      'officeName'         => $retsOffice['OfficeName'],
      'officeAddress1'     => $retsOffice['StreetAddress'],
      'officeCity'         => $retsOffice['StreetCity'],
      'officeState'        => $retsOffice['StreetStateOrProvince'],
      'officeZip'          => $retsOffice['StreetPostalCode'],
      'officePhone'        => $retsOffice['Phone'],
      'officeWeb'          => $retsOffice['WebPageAddress'],
      'officeBroker'       => $retsOffice['DesignatedBrokerName'],
      'officeBrokerMLSID'  => $retsOffice['DesignatedBroker'],
   ]);
}
