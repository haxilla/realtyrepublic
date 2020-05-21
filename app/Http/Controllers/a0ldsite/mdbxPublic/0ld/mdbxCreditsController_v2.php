<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\models\core\propagent;
use App\models\admin\adminOption;
use App\models\core\allorder;
use App\User;
use Auth;

class mdbxCreditsController_v2 extends Controller
{

   public function mdbxNewPurchase(){

      //get variables from form
      $amt=request('amt');
      $newPurchaseEmail=request('newPurchaseEmail');
      $purchaseDesc=request('purchaseDesc');

      //if any expected variable missing, error out
      if(!$amt||!$newPurchaseEmail||!$purchaseDesc){
         dd('error-line25-mdbxCreditsController',$amt,$newPurchaseEmail,$purchaseDesc);}

      //if not an expected number, error out
      if($amt!=='20' && $amt!=='40' && $amt!=='60'
      && $amt !=='100' && $amt !=='135' & $amt !== '160'
      && $amt !=='99' && $amt !=='120'){
         dd('error-line31-mdbxCreditsController');}

      //  check for existing username
      $dup=propagent::where('xxAgtUname','=',"$newPurchaseEmail")
      ->orWhere('agtUname','=',"$newPurchaseEmail")
      ->first();

      //if exists its a duplicate, redirect
      if($dup){
         return back()
         ->with('purchaseDup','Username Already Exists');}

      //set variable for trialcheck.php include below
      $theEmail   = $newPurchaseEmail;
      //and check if its on distro list
      include(app_path() . '/mdbxTrial/trialCheck.php');

      if($listName==='none'){
         //encrypt
         $key = Crypt::encrypt([
            'amt'             =>$amt,
            'purchaseDesc'    =>$purchaseDesc,
            'theEmail'        =>$newPurchaseEmail
         ]);
         //redirect to trial requests
         return \Redirect::route('public.newTrialRequest',[
            'key' => $key,
            'p'   => 1,
         ]);}

      //success if it gets this far
      //set variable
      include(app_path().'/functions/mdbxTrial/theListVariables.php');

      //set variables
      $accountType=0;
      $cbpDate=\Carbon\Carbon::now();
      $cbpAmt=$amt;
      $autoTrialDate=null;
      //add account propagent/agtoffice
      include(app_path().'/functions/mdbxTrial/createNewAccount.php');

      //send email
      $toEmail=$theEmail;
      $toName=$agtFullName;
      $sendThis="emails.mdbx.mdbxNewAccount";
      $theSubject="Welcome! New RealtyEmails Account Info";
      $data=[
         'agtFirst'=>$agtFirst,
         'theEmail'=>$theEmail,
         'agtPswd'=>$agtPswd,];

      include(app_path().'/functions/email/sendEmailTemplate.php');

      //encrypt values
      $enc = Crypt::encrypt([
         'umid'=>$umid,
         'amt'=>$amt,
         'theEmail'=>$newPurchaseEmail
      ]);

      //add Paypal Button with UMID info
      return \Redirect::route('public.newPurchaseConfirm',['enc'=>$enc]);

   }

   public function mdbxPurchaseConfirm(){

      $enc=request('enc');
      if(!$enc){
         dd('error-line87-mdbxCreditsController');}

      $decrypted  = Crypt::decrypt($enc);
      $amt        = $decrypted['amt'];
      $theEmail   = 'realtyemails@gmail.com'; //testing
      //$theEmail   = $decrypted['theEmail']; //live
      $xUmid      = $decrypted['umid'];

      $umid=Crypt::encryptString($xUmid);

      $getAdmin=adminOption::where('id','=','1')
      ->first();

      $paymentMode=$getAdmin['paymentMode'];
      return view('mdbxPublic.fullPages.newPurchaseConfirm',[
         'amt'          => $amt,
         'theEmail'     => $theEmail,
         'umid'         => $umid,
         'paymentMode'  => $paymentMode,
      ]);

   }

   public function mdbxPurchaseSuccess(){

      // return to merchant variables setup
      include(app_path().'/functions/mdbx/paypalRedirectVariables.php');

      if(!$custom||!$txn_id){
         dd('error-line118-mdbxCreditsController');}

      //set variables
      $umid=Crypt::decryptString($custom);
      $payComplete='n';
      $orderAdded='n';
      $agentExists='n';

      //check Queries
      $checkOrder=allorder::where('txn_id','=',"$txn_id")
      ->first();
      $checkAgent=propagent::where('id','=',"$umid")
      ->first();

      //adjust if found
      if($payment_status=='Completed'){
         $payComplete='y';}
      if($checkOrder){
         $orderAdded='y';}
      if($checkAgent){
         $agentExists='y';}

      if($payComplete=='y' && $orderAdded=='y' && $agentExists=='y'){
            //auto login if all conditions met
            include(app_path().'/functions/mdbx/paypalAutoLogin.php');
            //direct to Paypal Success Route
            //should be on controller that only allows logins
            return \Redirect::route("mdbxOrderReview")
            ->with('message', "Thank you for your purchase!");

      }elseif($payComplete=='y'){
            //create order from the redirect values
            //notate that its a redirect so it
            //doesnt error out later when duplicate
            include(app_path().'/functions/mdbx/paypalCreateRedirectOrder.php');

            if($agentExists=='y'){
               // sets thisPurchase,addCredit,addTime,desc
               include(app_path().'/functions/mdbx/mdbxPaypalItems.php');
               // sets currentAccount, currentRemCreds, or if time based expireDate
               include(app_path().'/functions/mdbx/mdbxAccountVariables.php');
               // performs proper function based on above scripts
               include(app_path().'/functions/mdbx/mdbxPaypalFunction.php');
               // if all goes well OK to log in & redirect
               include(app_path().'/functions/mdbx/paypalAutoLogin.php');
               //direct to Paypal Success Route
               //should be on controller that only allows logins
               return \Redirect::route("mdbxOrderReview")
               ->with('message', "Thank you for your purchase!");

            }else{
               // send error message to admin
               // agent doesnt exist error
               $data=[
               'errorMessage'=>"Agent Doesnt Exist - Paypal Return to Merchant",];

               $theSubject='Agent Doesnt Exist - Line174-mdbxCreditsController';
               include('paypalAdminError.php');

            }
      }

      if($payComplete == 'n'){
         //if status is not complete
         //show on screen message to wait
         dd('You shouldnt see this');
         //log to admin
         // agent doesnt exist error
         $data=[
         'errorMessage'=>"payComplete is n but paypal redirected?!
         Line188-mdbxCreditsController",];

         $theSubject='Paypal Return to Merchant with paycomplete=n';
         include('paypalAdminError.php');
      }

      // all other portions should redirect out
      // shouldnt make it here - end of function
      dd('error-line194-mdbxCreditsController');

   }

}
