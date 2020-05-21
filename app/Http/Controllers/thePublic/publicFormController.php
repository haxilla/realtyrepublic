<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;
use Request;

class publicFormController extends Controller
{

  public function joinNowSubmit(Request $request){

    //default && post variables
    $theEmail=request('theEmail');
    $captchaPresent=request('captchaPresent');
    $failCount=request('failCount');
    $trialAddress=request('trialAddress');
    $captchaNeeded=NULL;
    $captchaError=NULL;

    //low failcount (less than 3)
    if($failCount<3 && !$captchaPresent){

      //no recaptcha
      $validator = \Validator::make($request::all(), [
        'theEmail'       => 'bail|required|email:filter',
      ]);

    //high failCount (more than 3)
    }else{

      //recaptcha needed
      $captchaNeeded=1;

      //check post
      $validator = \Validator::make($request::all(), [
        'theEmail'             => 'bail|required|email:filter',
        'g-recaptcha-response' => 'required',
      ]);}

    //failed validation send reply
    if ($validator->fails()){
      $failCount++;
      return response()->json([
        'status'          =>'error',
        'errors'          =>$validator->errors()->all(),
        'failCount'       =>$failCount,
        'captchaPresent'  =>$captchaPresent,
      ]);}

    //check captcha reply
    if($captchaNeeded){
      include(app_path().'/functions/captchaCheck.php');}

    //if captchaError send reply
    if ($captchaError){
      //increase failCount
      $failCount++;
      //send reply
      return response()->json([
        'status'          =>'error',
        'captchaError'    =>1,
        'failCount'       =>$failCount,
        'captchaPresent'  =>$captchaPresent,
      ]);}

    //passed validation
    //dup test
    include(app_path().'/trialAccount/dupCheck.php');

    //if main found
    if($dupCheck){
      $data=['Account Already Exists with this Username!'];
      return response()->json([
        'status'    => 'error',
        'errors'    => $data,
        'agtUname'  => $theEmail
      ]);}

    //if previous trial found
    if($dupImport){
      $data=['Trial Already Started with this Username!'];
      return response()->json([
        'status'    => 'error',
        'errors'    => $data,
        'agtUname'  => $theEmail
      ]);}

    //check distro lists
    include(app_path().'/trialAccount/trialCheckList.php');

    //returns listName
    if($listName=='none'){
      //adds user and sets key
      include(app_path().'/trialAccount/unimportableUser.php');
      //respond/redirect with key
      return response()->json([
        'status'=>'unimportable',
        'key'=>$key
      ]);}

    //found on list
    return response()->json([
      'status'    => 'success',
      'listName'  => $listName
    ]);

  }

  //main landing page submission
  public function freeTrialSubmit(Request $request){
    //get variables
    $theEmail=request('theEmail');
    $trialAddress=request('trialAddress');
    $fromForm=request('fromForm');
    //validate
    $validator = \Validator::make($request::all(), [
     'theEmail'       => 'bail|required|email',
     'trialAddress'   => 'bail|required|min:3',]);
    //exit if validation errors
    if ($validator->fails()){
      return response()->json(['errors'=>$validator->errors()->all()]);}

    //passed validation
    //dup test
    include(app_path().'/trialAccount/dupCheck.php');

    //if main found
    if($dupCheck){
      $data=['Account Already Exists with this Username!'];
        return response()->json(['errors'=>$data,'agtUname'=>$theEmail
      ]);}
    //if previous trial found
    if($dupImport){
      $data=['Trial Already Started with this Username!'];
        return response()->json(['errors'=>$data,'agtUname'=>$theEmail
      ]);}

    //check lists
    include(app_path().'/trialAccount/trialCheckList.php');
    //returns listName
    if($listName=='none'){
      //adds user and sets key
      include(app_path().'/trialAccount/unimportableUser.php');
      //respond/redirect with key
      return response()->json(['status'=>'unimportable','key'=>$key]);}

    //if here there was a listName Found
    dd('listFound!');

  }

  //manual signup form when unimportable
  public function trialFormShow(){

    include(app_path().'/trialAccount/freeTrialForm.php');

    $html=\View::make('mdbxPublic.render.freeTrial.signupForm')
    ->with('theEmail',$theEmail)
    ->with('key',$key)
    ->with('amt',0)
    ->with('purchaseDesc',null);

    echo $html;

  }

  //submission of manual signup form
  public function trialFormSubmit(Request $request){

    //check form
    include(app_path().'/trialAccount/newAccessCheck.php');

    //if failure send error messages
    if (!$validator->passes()){
       return response()->json([
         'errors'=>$validator->errors()->all()]);}

    //validation passed - add to database here
    include(app_path().'/trialAccount/unimportableUpdate.php');

    //return success message
    return response()->json([
      'success'=>'true',
    ]);

  }

}
