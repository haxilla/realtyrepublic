<?php
namespace Listener;

use App\models\admin\newaccessrequest;
use App\models\admin\importableTrial;
use App\models\admin\adminOption;
//include code
require('includes/mdbxIPNpaypal.php');
//use the IPN
use PaypalIPN;
$ipn = new PaypalIPN();
//query for 
$getMode=adminOption::first();
//set
$paymentMode=$getMode['paymentMode'];
if($paymentMode!=='LIVE'){
  $ipn->useSandbox();}

//verified
$verified = $ipn->verifyIPN();
//if not verified
if (!$verified){
  //VALIDATION FAILURE
  //send admin email about validation failure
  $data=[
  'errorMessage'=>
  'error with Paypal Validation - check line 19 mdbxIPNsimple',];
  //send error email to admin
  $theSubject='Error with Paypal Validation';
  include('includes/paypalAdminError.php');}

//continue on if not caught above
//determine user
//set IPN variables
include('includes/paypalIPNVariables.php');
//check payment status for completed
include('includes/checkPaymentStatus.php');
//check for dups on txn_id
include('includes/paypalDupTxn.php');
//get custom field
$theID = $_POST['custom'];
//assume new account first
$accountType=1;
//try newaccess
$newAccess=newaccessrequest::where('key','=',$theID)
->whereNull('firstPurchase')
->first();
//if found its newAccess non-import account
if($newAccess){
  //add new account
  include(app_path().'/mdbxPaypal/accountSetups/firstPurchase/newAccessAccount1.php');}

//if not new find existing member
if(!$newAccess){
  //try umid
  include('includes/tryUmid.php');
  //query agent account
  include('includes/checkAgent.php');
  //process info
  include('includes/mdbxPaypalFunction.php');}
  
//all checks passed
//insert into order tables
include('includes/paypalCreateIPNorder.php');


// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");
