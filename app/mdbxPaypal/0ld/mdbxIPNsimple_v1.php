<?php
namespace Listener;

use App\models\core\allorder;
use App\models\core\propagent;
use App\models\admin\newaccessrequest;
use Illuminate\Support\Facades\Crypt;

require('includes/mdbxIPNpaypal.php');

use PaypalIPN;
$ipn = new PaypalIPN();
// Use the sandbox endpoint during testing.
//$ipn->useSandbox();
$verified = $ipn->verifyIPN();

if ($verified){
  //determine user
  $userID = $_POST['custom'];
  $umid=Crypt::decryptString($userID);
  $checkAgent=propagent::where('id','=',"$umid")
  ->first();

  if(!$checkAgent){
    //ERROR send admin email
    $data=[
    'errorMessage'=>
    'agent doesnt exist! error-line27-mdbxIPNsimple',];
    //send error email to admin
    // this is if the purchase is neither 3 or 5
    $theSubject='Error with UMID!';
    include('includes/paypalAdminError.php');}

  //set username & fullname
  $agtUname=$checkAgent['agtUname'];
  $agtFullName=$checkAgent['agtFullName'];
  //check both fields for now
  if(!$agtUname){
    $agtUname=$checkAgent['xxAgtUname'];}
  //error if not found
  if(!$agtUname){
    $data=[
      'errorMessage'=>
      'NO USERNAME - error-line44-mdbxIPNsimple',];
    //send error email to admin
    $theSubject='NO USERNAME ERROR';
    include('includes/paypalAdminError.php');}

  //all checks passed//
  //set IPN variables
  include('includes/paypalIPNVariables.php');
  //check for dups on txn_id
  include('includes/paypalDupTxn.php');
  //insert into order tables
  include('includes/paypalCreateIPNorder.php');
  //paypal item number variables
  include('includes/mdbxPaypalItems.php');
  //find currentAccount Info
  include('includes/mdbxAccountVariables.php');
  //process info

  include('includes/mdbxPaypalFunction.php');

}else{

    //VALIDATION FAILURE
    //send admin email about validation failure
    $data=[
    'errorMessage'=>
    'error with Paypal Validation -
    check line 70 mdbxIPNsimple',];
    //send error email to admin
    $theSubject='Error with Paypal Validation';
    include('includes/paypalAdminError.php');

}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");
