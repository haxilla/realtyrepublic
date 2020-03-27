<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\models\core\propagent;
use App\models\admin\adminOption;
use App\models\core\allorder;
use App\models\core\User;
use Auth;

class mdbxPaypalReturnController extends Controller
{

   public function success(){

      // return to merchant variables setup
      include(app_path().
         '/functions/mdbxPaypal/returnToMerchant/redirectVariables.php');

      if(!$custom||!$txn_id){
         $data=[
         'errorMessage'=>"check line23-mdbxPaypalReturnController",];

         $theSubject='Paypal Return to Merchant Error';
         include(app_path().'/functions/mdbxPaypal/includes/paypalAdminError.php');}

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
            include(app_path().
               '/functions/mdbxPaypal/returnToMerchant/paypalAutoLogin.php');
            //direct to Paypal Success Route
            //should be on controller that only allows logins

            return \Redirect::route("member.paypalOrderReview")
            ->with('message', "Thank you for your purchase!");

      }elseif($payComplete=='y'){
            //create order from the redirect values
            //notate that its a redirect so it
            //doesnt error out later when duplicate

            include(app_path().
               '/functions/mdbxPaypal/returnToMerchant/createRedirectOrder.php');

            if($agentExists=='y'){
               // sets thisPurchase,addCredit,addTime,desc
               include(app_path().'/functions/mdbxPaypal/includes/mdbxPaypalItems.php');
               // sets currentAccount, currentRemCreds, or if time based expireDate
               include(app_path().'/functions/mdbxPaypal/includes/mdbxAccountVariables.php');
               // performs proper function based on above scripts
               include(app_path().'/functions/mdbxPaypal/includes/mdbxPaypalFunction.php');
               // if all goes well OK to log in & redirect
               include(app_path().'/functions/mdbxPaypal/returnToMerchant/paypalAutoLogin.php');
               //direct to Paypal Success Route
               //should be on controller that only allows logins
               return \Redirect::route("member.paypalOrderReview")
               ->with('message', "Thank you for your purchase!");

            }else{
               // send error message to admin
               // agent doesnt exist error
               $data=[
               'errorMessage'=>"Agent Doesnt Exist - Paypal Return to Merchant",];

               $theSubject='Agent Doesnt Exist - Line174-mdbxCreditsController';
               include(app_path().'/functions/mdbxPaypal/includes/paypalAdminError.php');

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
         include(app_path().'/functions/mdbxPaypal/includes/paypalAdminError.php');
      }

      // all other portions should redirect out
      // shouldnt make it here - end of function
      dd('error-line194-mdbxCreditsController');

   }

}
