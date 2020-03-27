<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\models\core\propagent;
use App\models\core\propflyer;
use App\models\core\propmapping;
use App\models\core\propmeta;
use App\models\admin\adminOption;
use Illuminate\Support\Facades\Crypt;

class mdbxTrialCheckController_v1 extends Controller
{
  
  public function trialCheck(Request $request){
    //email form value
    $theEmail=request::input('theEmail');
    $trialAddress=request::input('trialAddress');
    $fromForm=request::input('fromForm');
    //required field and must be an email to pass
    //if join now modal different error process
    if($fromForm=='theModal'){
      //email only
      $validator = Validator::make($request::all(), [
        'theEmail'             => 'bail|required|email',
        'g-recaptcha-response' => 'required',]);
      //exit if captcha invalid
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');
      //exit if validation errors
      if (!$validator->passes()) {
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('joinNowError','Missing Fields');}

    }else{
      //must have address
      $validator = Validator::make($request::all(), [
       'theEmail'       => 'bail|required|email',
       'trialAddress'   => 'bail|required|min:5',]);
      //exit if validation errors
      if (!$validator->passes()) {
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('trialFormError','Missing Fields');}}

    //dup trial check
    $dupcheck=propagent::select('id')
    ->where('agtUname','=',"$theEmail")
    ->orWhere('xxAgtUname','=',"$theEmail")
    ->orWhere('trialUname','=',"$theEmail")
    ->first();
    //if record is found redirect
    //to dup page with info
    if($dupcheck){
      return back()
      ->with('trialFormError','Duplicate Email')
      ->withInput()
      ->withErrors([
        'dup'=> 'You already have an account! Please log-in or reset password'
      ]);}

    //variable required - $theEmail -
    include(app_path() . '/mdbxTrial/trialCheck.php');
    //if result from trialCheck is none - redirect
    if($listName=='none'){
      $key = Crypt::encrypt([
        'theEmail'  => $theEmail,
        'amt'       => 0,
      ]);
      //redirect to --NOT ON ANY DISTRO LISTS--
      return \Redirect::route("public.newTrialRequest",[
        'key'=>$key,
      ]);}

    //**********************************************//
    // ** if all OK with trial checks continue!  ** //
    //**********************************************//

    //set autoDate
    $autoTrialDate=\Carbon\Carbon::now();
    $accountType=1;
    $cbpDate=null;
    $cbpAmt=0;
    //get variables
    //examples
    //Vacant/Subdivided Land: egbertd@aol.com - mlsid=092440
    //Residential: Debrealty@gmail.com - mlsid=215979
    //High Rise: merri@merriperryteam.com mlsid=220777
    //create account //returns umid for new agents id
    if($listName='glvar'){
      //get current listings $agtMlsID
      include(app_path().'/mdbxTrial/variables/theListVariablesGLVAR.php');
      //create new account //returns umid for new agentID
      include(app_path().'/mdbxTrial/createNewAccount.php');
      //import Listings
      include(app_path().'/mdbxTrial/glvar/importListings.php');
    }else{
      //only other choice for now is AZ
      include(app_path().'/mdbxTrial/theListVariablesAZ.php');
      //create new account
      include(app_path().'/mdbxTrial/createNewAccount.php');}
    
    
    //example: egbertd@aol.com - mlsid=092440
    //get current listings $agtMlsID

    //sets variables toEmail/toName & liveEmail / LiveName for original
    include(app_path().'/functions/email/variables/emailModes.php');

    dd($toEmail,$toName,$liveEmail,$liveName,'line105-mdbxTrialCheckController');

    $theSubject="Welcome to RealtyEmails! New Account Info";
    $sendThis="emails.mdbx.mdbxNewAccount";
    $data = [
      'agtFirst'    => $agtFirst,
      'liveEmail'   => $liveEmail,
      'liveName'    => $liveName,
      'agtPswd'     => $agtPswd,
    ];
    include(app_path().'/functions/email/sendEmailTemplate.php');
    //redirect
    return \Redirect::route('public.index')->with([
      'message'=> 'Trial Account Created!'
    ]);
  }

}
