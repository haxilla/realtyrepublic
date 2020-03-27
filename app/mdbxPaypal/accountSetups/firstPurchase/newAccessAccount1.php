<?php

use App\models\core\propagent;
use App\models\core\propagentmeta;
use App\models\core\propagentcleanup;
use App\models\core\agtoffice;
use App\models\admin\newaccessrequest;
use App\models\dev\masterVersion;

//set current date
$now=\Carbon\Carbon::now();

//set variables available in newaccessrequest
include(app_path().'/functions/mdbxPaypal/variables/newAccessVariables.php');
//get purchase info from item_num
include(app_path().'/functions/mdbxPaypal/includes/mdbxPaypalItems.php');
//set initial password
$agtPswd    = str_random(10);
$passHash   = bcrypt($agtPswd);
//set microversion
$microVersion=masterVersion::orderBy('id','desc')
->pluck('microVersion')
->first();

// 5 = credits // 3 = time
if($thisPurchase=='5'){
  //set expireDate
  $expireDate=null;
  //set email to send
  $sendThis='emails.purchases.newCreditAcct';
  //variables for newCreditAcctEmail
  $data=[
    'desc'      => $desc,
    'agtUname'  => $agtEmail,
    'agtPswd'   => $agtPswd,
    'refNumber' => $txn_id,
  ];

}elseif($thisPurchase=='3'){
  //set email to send
  $sendThis='emails.purchases.newUnlimitedAcct';
  //set future date
  $newExpireDate=$expireDate;
  //variables for newUnlimited Email
  $data=[
    'now'           => $now,
    'newExpireDate' => $newExpireDate,
    'desc'          => $desc,
    'agtUname'      => $agtEmail,
    'agtPswd'       => $agtPswd,
    'refNumber'     => $txn_id,
  ];

}else{
    //send error email to admin
    // Purchase type is neither 3 or 5
    $data=[
      'errorMessage'=>
      'error with Purchase Type - check line 307 mdbxIPNsimple - Account Type=1',];

    $theSubject='Error with Purchase Type';
    include('paypalAdminError.php');
}

//update credits
$new=propagent::create([
  'startDate'     => $now,
  'expireDate'    => $expireDate,
  'agtUname'      => $agtEmail,
  'agtPswd'       => $agtPswd,
  'passHash'      => $passHash,
  'microVersion'  => $microVersion,
  'last_txn'      => $txn_id,
  'agtFirst'      => $agtFirst,
  'agtLast'       => $agtLast,
  'agtFullName'   => $agtFullName,
  'agtDesigs'     => $agtDesigs,
  'agtWebsite'    => $agtWebsite,
  'agtMlsID'      => $agtMlsID,
  'officeID'      => $officeID,
  'remCreds'      => $addCredit,
  'accountType'   => $thisPurchase,
  'agtReview'     => 1,
]);
//set UMID
$umid=$new->id;
//generate newRemID
include(app_path().'/functions/keyGens/ezshortUID.php');
//set newRemID
$newRemID=$ezshortUID;
//propagentmeta
propagentmeta::create([
   'propagent_id'       => $umid,
   'newRemID'           => $newRemID,
]);
//propagentmeta
propagentcleanup::create([
   'propagent_id'       => $umid,
   'newRemID'           => $newRemID,
]);
//insert office
agtoffice::create([
   'newRemID'        => $newRemID,   
   'propagent_id'    => $umid,
   'officeID'        => $officeID,
   'officeName'      => $officeName,
   'officeAddress1'  => $officeAddress,
   'officeCity'      => $officeCity,
   'officeState'     => $officeState,
   'officeZip'       => $officeZip,
   'officePhone'     => $agtMainPhone,
]);
//update existing record
newaccessrequest::where('agtEmail','=',$agtEmail)
->update([
  'firstPurchase' => \Carbon\Carbon::now(),
  'umid'          => $umid,
]);

//set defaults
$toEmail=$agtEmail;
$toName=$agtFullName;
$fromEmail='support@realtyrepublic.com';
$fromName='RealtyEmails';
$theSubject='Welcome to RealtyEmails - New Account Created!';
//check mode & change if necessary
include(app_path().'/functions/adminOptions/liveOrTestMode.php');
//send mail function
\Mail::send($sendThis,$data,
function($message)
    use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
    $message->to($toEmail,$toName)
    ->from($fromEmail,$fromName)
    ->subject($theSubject);
});
