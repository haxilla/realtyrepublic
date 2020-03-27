<?php
//models
use App\models\core\propagent;
use App\models\core\agtoffice;
use App\models\dev\masterVersion;

$agtPswd    = str_random(10);
$passHash   = bcrypt($agtPswd);
$microVersion=masterVersion::orderBy('id','desc')
->pluck('microVersion')
->first();

include(app_path().'/rets/includes/login.php');
$agentPhoto = $rets->GetObject("Agent", "AgentPhoto",$matrixID,'*','1');
//set newRemID
include(app_path().'/functions/keyGens/ezshortUID.php');
$newRemID='zzztest_'.$ezshortUID;
//check create directory *requires newRemID*
include(app_path().'/mdbxTrial/makeAgtPhotoDirectories.php');
//run loop

foreach($agentPhoto as $the){
   //get location
   $agentPhoto=$the->getLocation();
   //dir path
   $dirPath="agentPhotos/$newRemID/";
   //filename
   $fileName=uniqid().'.jpg';
   //fullPath
   $fullPath=$dirPath.$fileName;
   $fullOriginalPath=$dirPath.'original/'.$fileName;
   //download
   file_put_contents($fullOriginalPath, file_get_contents($agentPhoto));
   //crop
   include(app_path().'/functions/imageControl/trimWhitespace3.php');
   echo "ORIG: <img src='$fullOriginalPath'><br>";
   echo "CROP: <img src='$fullPath'><br>";
}
dd($agentPhoto);

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
]);
//get UMID
$umid=$newAgent->id;

//propagentmeta
propagentmeta::create([
   'propagent_id' => $umid,
   'matrixID'     => $matrixID,
   'newRemID'     => $newRemID,
]);
//propagentmeta
propagentcleanup::create([
   'propagent_id' => $umid,
   'matrixID'     => $matrixID,
   'newRemID'     => $newRemID,
]);
//insert office
agtoffice::create([
   'eidx'            => $eidx,
   'propagent_id'    => $umid,
   'officeID'        => $officeID,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress1,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'officePhone'     => $officePhone,
]);
