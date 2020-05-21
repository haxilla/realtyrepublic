<?php

namespace App\Http\Controllers\member\a0ld;
use App\Http\Controllers\Controller;
use App\Jobs\passwordResetSend;
use Request;
use Auth;

class passwordResetController_v2 extends Controller
{

  public function formSubmit(Request $request){

    //include
    include(app_path().'/members/passwordReset/passwordReset_validate.php');

    if($validationError){
      return response()
      ->json([
        'errors'          => $validator->errors()->all(),
        'resetFailCount'  => $resetFailCount,
      ]);
    }

    include(app_path().'/members/passwordReset/passwordResetCheck.php');

    if($theUser){

      //adds to database
      include(app_path().'/members/passwordReset/passwordResetProcess.php');
      //gets $fromURL
      include(app_path().'/functions/fromURL.php');
      //set data
      $data=array(
        'agtUname'  =>$agtUname,
        'agtEmail'  =>$theUser['agtEmail'],
        'agtFirst'  =>$theUser['agtFirst'],
        'prl'       =>$prl,
        'fromURL'   =>$fromURL,);

      //create email
      $emailJob=(new passwordResetSend($data));

      // dispatch job
      dispatch($emailJob)
      ->onQueue('emails');

    }else{

      //user does not exist
      //log attempt & notify admin
      include(app_path().'/members/passwordReset/passwordResetFail.php');}

    //send reply
    return response()
    ->json([
      'status'        => 'success',
      'resetRequest'  => $agtPswdReset,
    ]);

  }

  public function linkClicked(){
    //process url & return $agentInfo
    include(app_path().'/members/passwordReset/prlClick.php');
    if($agentInfo['agtUname']){
      $agtUname=$agentInfo['agtUname'];
    }else if($agentInfo['xxAgtUname']){
      $agtUname=$agentInfo['xxAgtUname'];
    }else{
      dd('error-line76-passwordResetController');}

    //remove this for production
    return view('member.passwordResetForm',[
      'agentInfo' => $agentInfo,
      'agtUname'  => $agtUname,
      'prl'       => $prl,
    ]);

    //return view if $agentInfo valid
    return \Redirect::route('member.passwordResetView')
    ->with(['agtUname'=>$agtUname])
    ->with(['agentInfo'=>$agentInfo]);

  }

  public function resetView(){

    //value only contained in correct redirect
    $agentInfo=\Session::get('agentInfo');
    $agtUname=\Session::get('agtUname');

    //new requests to the page wont work
    //ie page refresh or via direct url
    if(!$agentInfo||!$agtUname){
      return abort(500,
      'Page accessible by email link only');}

    //view returned on initial click with
    //session variable only
    return view('member.passwordResetForm',[
      'agentInfo'=>$agentInfo,
    ]);

  }

  public function passwordChangeSubmit(Request $request){

    //form logic
    include(app_path().'/members/passwordReset/passwordChange.php');
    //validation errors
    if($validator->fails()){
      return response()
      ->json([
        'status'  => 'Validation Errors',
        'errors'  => $validator->errors()->all(),
      ]);}

    //perform change in database
    include(app_path().'/members/passwordReset/passwordChangeUpdate.php');

    //return success
    return response()
    ->json([
      'status'  =>  'success'
    ]);

  }

}
