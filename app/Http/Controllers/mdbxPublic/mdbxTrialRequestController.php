<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use App\models\admin\adminOption;
use App\models\admin\newaccessrequest;
use Validator;
use Request;

class mdbxTrialRequestController extends Controller
{
   public function show(){
      //get key
      $key=request('key');
      $shortKey=request('shortKey');
      //error if none
      if(!$key && !$shortKey){
         dd('error-line19-newAccessRequestController');}
      // p means they came from a payment screen
      // no match found - redirected to trial form
      $p=request('p');
      //if key set
      if($key){
         try{
            //decrypt
            $decrypted=Crypt::decrypt($key);
         }catch(\Exception $e){      
            //if incorrect decryption handle custom error
            dd('Sorry there was an error.  Line31-newAccessRequestController');}

         $theEmail=$decrypted['theEmail'];
         $amt=$decrypted['amt'];
         $purchaseDesc=$decrypted['purchaseDesc'];
         //error if none
         if(!$theEmail){
            dd('line38-mdbxTrialRequestController');}

         //this is the form to fill out
         return view('mdbxPublic.fullPages.newAccessRequest',[
            'theEmail'     => $theEmail,
            'purchaseDesc' => $purchaseDesc,
            'key'          => $key,
            'amt'          => $amt,
            'p'            => $p,
         ]);}
      //if shortKey set
      if($shortKey){
         //get theAgent
         $theAgent=newaccessrequest::where('key','=',$shortKey)
         ->first();
         //error if none
         if(!$theAgent){
            dd('error-line54-mdbxTrialRequestController');}
         //this is editable form
         return view('mdbxPublic.fullPages.newAccessEdit',[
            'theAgent'     => $theAgent,
            'shortKey'     => $shortKey,
            'amt'          => $theAgent['amt'],
            'purchaseDesc' => $theAgent['purchaseDesc'],
            'p'            => $p,
         ]);}

      dd('error-line65-mdbxTrialRequestController');
   }

   public function post(Request $request){
      //get key
      $key=request('key');
      $shortKey=request('shortKey');
      $purchaseAmt=request('amt');
      $purchaseDesc=request('purchaseDesc');
      //if no key error
      if(!$key && !$shortKey){
         dd('error-line76-mdbxTrialRequestController');}
      //could recheck here for decryption
         // ** decrypt key ** //

      //get variables from form request
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');
      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate.php');
      //check captcha
      $errorMessage="trialRequestPost Error";
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');
      //if failure go back
      if (!$validator->passes()){
         return redirect()
         ->back()
         ->withInput()
         ->withErrors($validator);}

      if(!$shortKey){
         //set shortKey for data storage
         $shortKey=str_random(25);
         //if all OK proceed to insert
         include(app_path().'/functions/inputHelpers/trialInfoInsertOrUpdate.php');
      }else{
         include(app_path().'/functions/inputHelpers/trialInfoEdit.php');}

      //send Admin Email
      include(app_path().'/email/admin_newAccountNotice.php');
      //redirect to confirmation page
      if($purchaseAmt){
         return \Redirect::route('public.newPurchaseConfirm',[
            'shortKey'        => $shortKey,
            'p'               => 1,
         ]);}

      // *** if not redirected - new access request without purchase
      // *** account pending until admin review
      // *** send confirmation link email
      // *** send to index with pending modal

      //set currentURL
      include(app_path().'/functions/fromURL.php');
      //set email variables
      $sendThis   = 'emails.mdbx.noMatchEmailConfirm';
      $toName     = $agtFirst.' '.$agtLast;
      $toEmail    = $agtEmail;
      $theSubject = 'RealtyEmails - Account Confirmation Request';
      $data       = [
         'agtFirst'  => $agtFirst,
         'fromURL'   => $fromURL,
         'key'       => $shortKey,
      ];
      //check mode
      include(app_path().'/functions/adminOptions/liveOrTestMode.php');
      //send Email
      include(app_path().'/email/sendEmailTemplate.php');
      //redirect back and trigger pending account modal
      return \Redirect::route("public.index")
         ->with('confirmEmail', "Pending Email Confirmation");

   }

   public function trialRequestEmailConfirm(){
      //get key
      $key=request('key');
      //if none
      if(!$key){
         //redirect out to index page with message
         //modal attached to message - Sorry, error processing that link!
         return \Redirect::route("public.index")
            ->with('confirmLinkInvalid', "Confirm Link Unavailable");}

      //validate key
      $check=newaccessrequest::select('id')
      ->where('key','=',"$key")
      ->first();
      //if errors
      if(!$check){
         //redirect out to wrong link page
         //redirect out to index page with message
         //modal attached to message - Sorry, error processing that link!
         return \Redirect::route("public.index")
            ->with('confirmLinkInvalid', "Invalid Confirm Link");}
            
      //get ID
      $thisID=$check['id'];
      //update ID
      newaccessrequest::where('id','=',"$thisID")
      ->update([
         'emailConfirm'=>1,
         'emailConfirmDate'=>\Carbon\Carbon::now(),
      ]);

      // redirect to index with success message
      return \Redirect::route("public.index")
         ->with('trialEmailConfirmed', $key);
   }

   public function pendingTrialAddress(Request $request){

      //get variables
      $pendingTrialAddress=request('pendingTrialAddress');
      $pendingTrialKey=request('pendingTrialKey');

      // ***  if no pendingTrialKey
      if(!$pendingTrialKey){
         //set error
         $data=['Error Processing Request - Line182-trialRequestController'];
         //respond with errors
         return response()->json(['errors'=>$data]);}

      $validator = Validator::make($request::all(), [
         'pendingTrialAddress'  => 'bail|required|min:3',
         'g-recaptcha-response' => 'bail|required',
      ]);

      //exit on validation failure of required fields
      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()->all()]);}

      //captcha validation
      //set error message for captcha
      $errorMessage="pendingTrialAddressError";
      //exit if captcha invalid
      include(app_path().'/functions/inputHelpers/captchaV2validate_ajax.php');

      // *** update newAccess
      $newAccess=newaccessrequest::where('key','=',$pendingTrialKey)
      ->first();
      //error if none
      if(!$newAccess){
         //set data
         $data=['Error Processing Request - Line193-trialRequestController'];
         //respond with errors
         return response()->json(['errors'=>$data]);}


      //if not redirected, update
      newaccessrequest::where('key','=',$pendingTrialKey)
      ->update([
         'pendingTrialAddress'=>$pendingTrialAddress,
      ]);

      //return with success message
      $data=['pendingTrialAddressSuccess'];
      return response()->json(['success'=>$data]);

   }

}
