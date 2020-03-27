<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;
use App\models\admin\adminOption;
use App\models\admin\newaccessrequest;
use Validator;
use Request;

class mdbxTrialRequestController_v1 extends Controller
{
   public function show(){
      $key=request('key');
      // p means they came from a payment screen
      // no match found - redirected to trial form
      $p=request('p');

      //if no key error
      if(!$key){
         dd('error-line18-newAccessRequestController');}

      //if incorrect decryption handle custom error
      try{
         $decrypted=Crypt::decrypt($key);
      }catch(\Exception $e){
         dd('Sorry there was an error.  Line28-newAccessRequestController');}

      $theEmail=$decrypted['theEmail'];
      $amt=$decrypted['amt'];
      $purchaseDesc=$decrypted['purchaseDesc'];
      //if variable not found
      if(!$theEmail){
         dd('error-line28-newAccessRequestController');}
      //this is the form to fill out
      return view('mdbxPublic.fullPages.newAccessRequest',[
         'theEmail'=>$theEmail,
         'purchaseDesc'=>$purchaseDesc,
         'key'=>$key,
         'amt'=>$amt,
         'p'  =>$p,
      ]);
   }

   public function post(Request $request){
      //get key
      $key=request('key');
      $amt=request('amt');
      //if no key error
      if(!$key){
         dd('error-line39-newAccessRequestController');}
      //could recheck here for decryption
         // ** decrypt key ** //

      //set shortKey for data storage
      $shortKey=str_random(25);
      //get variables from form request
      include(app_path().'/functions/inputHelpers/agentInfoRequest.php');
      //validate
      include(app_path().'/functions/inputHelpers/agentInfoValidate.php');
      //check captcha
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');
      //if failure go back
      if (!$validator->passes()){
         return redirect()
         ->back()
         ->withInput()
         ->withErrors($validator);}

      //if all OK proceed to insert
      include(app_path().'/functions/inputHelpers/trialInfoInsertOrUpdate.php');
      //get URL
      include(app_path().'/functions/fromURL.php');
      //send admin email
      $toEmail       = 'realtyemails@gmail.com';
      $toName        = "Chris Mistretta";
      $theSubject    = 'New Trial Account Request!';
      $data          = [
         'agtFirst'        => $agtFirst,
         'agtLast'         => $agtLast,
         'agtFullName'     => $agtFirst.' '.$agtLast,
         'agtEmail'        => $agtEmail,
         'agtMainPhone'    => $agtMainPhone,
         'agtWebsite'      => $agtWebsite,
         'agtDesigs'       => $agtDesigs,
         'officeName'      => $officeName,
         'officeAddress1'  => $officeAddress1,
         'officeCity'      => $officeCity,
         'officeState'     => $officeState,
         'officeZip'       => $officeZip,
         'key'             => $shortKey,
         'fromURL'         => $fromURL,
         'amt'             => $amt,
      ];
      //admin notice
      \Mail::send('emails.admin.newTrialRequest',
         $data, function($message) use ($data,$toEmail,$toName,$theSubject){
         $message->to($toEmail,$toName)
         ->subject($theSubject);
      });
      //set variables toEmail,toName,liveEmail,liveName
      include(app_path().'/functions/email/variables/emailModes.php');
      //set subject
      $theSubject="RealtyEmails - Trial Request Received!";
      if($amt){
         $theSubject="RealtyEmails - Confirm Your Email!";}
      //send Email to agent
      if($amt){
         //send Email to agent
         $sendThis='emails.mdbx.noMatchConfirmBeforePurchase';
      }else{
         //send Email to agent
         $sendThis='emails.mdbx.noMatchEmailConfirm';}

      //mail function
      include(app_path().'/functions/email/sendEmailTemplate.php');

      //redirect out
      $msg="Trial Account Pending";
         if($amt){
            $msg="Confirm Before Purchase";}

      return \Redirect::route("public.index")
         ->with('message', $msg);

   }

   public function trialRequestEmailConfirm(){
      //get key
      $key=request('key');
      //if none
      if(!$key){
         //redirect out to index page with message
         //modal attached to message - Sorry, error processing that link!
         return \Redirect::route("public.index")
            ->with('message', "Invalid Link");}

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
            ->with('message', "Invalid Link");}
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
         ->with('message', "Email Confirmation Success");
   }

}
