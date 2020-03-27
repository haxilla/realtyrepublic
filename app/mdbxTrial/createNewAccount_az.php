<?php
//models
use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\core\propoffice;
use App\models\core\agtoffice;
use App\models\rets\glvarOffice;
use App\models\admin\importableTrial;
use App\models\dev\masterVersion;

$agtPswd    = str_random(10);
$passHash   = bcrypt($agtPswd);
$microVersion=masterVersion::orderBy('id','desc')
->pluck('microVersion')
->first();

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
   'agtUname'        => $trialEmail,
   'agtEmail'        => $trialEmail,
   'trialPswd'       => $agtPswd,
   'trialKey'        => $theKey,
   'passHash'        => $passHash,
   'eidx'            => $eidx,
   'microVersion'    => $microVersion,
   'agtReview'       => 1,
   'autoTrialDate'   => $autoTrialDate,
   'cbpAmt'          => $cbpAmt,
   'cbpDate'         => $cbpDate,
]);
//get UMID
$umid=$newAgent->id;
//update umid
importableTrial::where('sk1','=',$theKey)
->update([
   'propagent_id' => $umid,
]);
//generate newRemID
include(app_path().'/functions/keyGens/ezshortUID.php');
$newRemID=$ezshortUID;
//propagentmeta
propagentmeta::create([
   'propagent_id'       => $umid,
   'newRemID'           => $newRemID,
   'agtPhotoUploadDate' => \Carbon\Carbon::now(),
   'hasAgtPhoto'        => $hasAgtPhoto,
   'eidx'               => $eidx,
]);
//propagentmeta
propagentcleanup::create([
   'propagent_id'       => $umid,
   'newRemID'           => $newRemID,
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
