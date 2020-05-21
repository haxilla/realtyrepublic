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
use App\models\admin\importableTrial;
use Illuminate\Support\Facades\Crypt;

class mdbxTrialCheckController extends Controller
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
        'g-recaptcha-response' => 'bail|required',]);
      //exit if validation errors
      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()->all()]);}

      //set error message for captcha
      $errorMessage="joinNowError";
      //exit if captcha invalid
      include(app_path().'/functions/inputHelpers/captchaV2validate.php');

    }else{
      //must have address
      $validator = Validator::make($request::all(), [
       'theEmail'       => 'bail|required|email',
       'trialAddress'   => 'bail|required|min:3',]);
      //exit if validation errors
      if ($validator->fails()) {
        return response()->json(['errors'=>$validator->errors()->all()]);}}

    //dup trial check
    $dupcheck=propagent::select('id')
    ->where('agtUname','=',"$theEmail")
    ->orWhere('xxAgtUname','=',"$theEmail")
    ->orWhere('trialUname','=',"$theEmail")
    ->first();
    //if record is found redirect
    //to dup page with info
    if($dupcheck){
      $data=['Account Already Exists with this Username!'];
        return response()->json(['errors'=>$data,'agtUname'=>$theEmail
      ]);}

    //variable required - $theEmail -
    include(app_path() . '/mdbxTrial/trialCheck.php');
    //if result from trialCheck is none - redirect
    if($listName=='none'){
      //define key
      $theKey = Crypt::encrypt([
        'theEmail'      => $theEmail,
        'amt'           => 0,
        'purchaseDesc'  => NULL,
      ]);
      //respond with key
      return response()->json(['status'=>'newAccess','theKey'=>$theKey]);}

    //if not redirected, check importableTrials for dup
    $dupCheck=importableTrial::where('trialEmail','=',"$theEmail")
    ->select('sk1')
    ->first();
    //error if match
    if($dupCheck){
      $data=['Account Already Exists with this Username!'];
      return response()->json(['errors'=>$data,'agtUname'=>$theEmail
    ]);}

    //variables for importableTrial table
    include(app_path().'/mdbxTrial/variables/preimportVariables.php');
    //returns sk1
    include(app_path().'/members/keygens/mdbxGenPswd.php');
    //set key
    $theKey        = $sk1;
    $trialEmail = $theEmail;
    //insert into table
    importableTrial::create([
      'sk1'           => $theKey,
      'trialEmail'    => $trialEmail,
      'listName'      => $listName,
      'trialAddress'  => $trialAddress,
      'mlsName'       => $mlsName,
      'mlsID'         => $mlsID,
      'officeID'      => $officeID
    ]);

    //default variables
    include(app_path().'/mdbxTrial/variables/defaultAccountVariables.php');
    //determine list   
    //create account
    if($listName=='glvar'){
      //get current listings $agtMlsID
      include(app_path().'/mdbxTrial/variables/listVariables_glvar.php');
      //create new account //returns umid for new agentID
      include(app_path().'/mdbxTrial/createNewAccount_glvar.php');
      //import Listings
      include(app_path().'/mdbxTrial/glvar/importListings.php');
    }else{
      //only other choice for now is AZ
      include(app_path().'/mdbxTrial/variables/listVariables_az.php');
      //create new account
      include(app_path().'/mdbxTrial/createNewAccount_az.php');}

    //check mode
    include(app_path().'/email/variables/emailModes.php');
    //set email 
    $theSubject="Welcome to RealtyEmails! New Trial Account Info";
    $sendThis="emails.members.newTrialAcct_noAddress";
    $data = [
      'agtUname'    => $trialEmail,
      'agtPswd'     => $agtPswd,
    ];
    //send email
    include(app_path().'/email/sendEmailTemplate.php');
    //redirect with response
    return response()->json(['status'=>'Success']);
  }

  public function importableTrialCheck(Request $request){
    //set theKey
    $theKey=request::input('theKey');
    $validator = Validator::make($request::all(), [
      'theKey'                => 'bail|required',
      'g-recaptcha-response'  => 'bail|required',]);

    //exit if validation errors
    if ($validator->fails()) {
      return response()->json(['errors'=>$validator->errors()->all()]);}

    include(app_path().'/functions/inputHelpers/captchaV2validate_ajax.php');
    //check key
    $checkKey=importableTrial::where('sk1','=',$theKey)
    ->first();
    //if no record found send back error
    if(!$checkKey){
      return response()->json(['errors'=>'KeyError']);}

    //update if found
    importableTrial::where('sk1','=',$theKey)
    ->update([
        'captchaConfirmed'=>\Carbon\Carbon::now(),
    ]);

    return response()->json(['status'=>'Success','theKey'=>$theKey]);
  }

  public function startImport(){
    //set theKey
    $theKey=request('key');
    //error if none
    if(!$theKey){
      dd('error-line132-mdbxTrialCheckController');}
    //query record
    $checkKey=importableTrial::where('sk1','=',$theKey)
    ->first();
    //error if none
    if(!$checkKey){
      dd('error-line138-mdbxTrialCheckController');}

    //set variables from key
    $listName=$checkKey['listName'];
    $mlsID=$checkKey['mlsID'];
    $officeID=$checkKey['officeID'];
    $trialEmail=$checkKey['trialEmail'];
    $trialAddress=$checkKey['trialAddress'];
    //default variables
    include(app_path().'/mdbxTrial/variables/defaultAccountVariables');
    //determine list
    if($listName=='glvar'){
      //get current listings $agtMlsID
      include(app_path().'/mdbxTrial/variables/listVariables_glvar.php');
      //create new account //returns umid for new agentID
      include(app_path().'/mdbxTrial/createNewAccount_glvar.php');
      //import Listings
      include(app_path().'/mdbxTrial/glvar/importListings.php');
    }else{
      //only other choice for now is AZ
      include(app_path().'/mdbxTrial/variables/listVariables_az.php');
      //create new account
      include(app_path().'/mdbxTrial/createNewAccount_az.php');}

    //get Email Mode  
    //sets variables toEmail/toName & liveEmail / LiveName for original
    include(app_path().'/email/variables/emailModes.php');
    //Send Email
    $theSubject="Welcome to RealtyEmails! New Account Info";
    $sendThis="emails.mdbx.mdbxNewAccount";
    $data = [
      'agtFirst'    => $agtFirst,
      'liveEmail'   => $liveEmail,
      'liveName'    => $liveName,
      'agtPswd'     => $agtPswd,
      'trialEmail'  => $trialEmail
    ];
    include(app_path().'/email/sendEmailTemplate.php');
    //redirect
    return \Redirect::route('public.index')->with([
      'message'=> 'Trial Account Created!'
    ]);
  }







}
