<?php

use App\models\core\propagent;

//set variables available in newaccessrequest
include(app_path().'/functions/mdbxPaypal/variables/newAccessVariables.php');
//get purchase info from item_num
include(app_path().'/functions/mdbxPaypal/includes/mdbxPaypalItems.php');
//set email subject
$theSubject="RealtyEmails Purchase - $desc";
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

}elseif($thisPurchase=='3'){
  //set expireDate
  $expireDate=
  //set email to send
  $sendThis='emails.purchases.newCreditAcct';


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
  'startDate'     => \Carbon\Carbon::now(),
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
//get UMID
$umid=$new->id;
//generate newRemID
include(app_path().'/functions/keyGens/ezshortUID.php');
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

//send NEW credit based account email
$data=[
  'addCredit'       => $amt,
  'desc'            => $desc
];

$theSubject="RealtyEmails Purchase - $desc";
\Mail::send("$sendThis",$data,
function($message)
    use ($data,$toEmail,$toName,$fromEmail,$fromName,$theSubject){
    $message->to($toEmail,$toName)
    ->from($fromEmail,$fromName)
    ->subject($theSubject);
});
