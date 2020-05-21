<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use App\Jobs\passwordRequestSend;
use Request;
use Auth;

class passwordRequestController extends Controller
{

  public function formSubmit(Request $request){

    //validate the form
    include(app_path().'/members/passwordRequest/passwordRequest_validate.php');

    //exit if validation errors
    if($validationError){
      return response()
      ->json([
        'errors'          => $validator->errors()->all(),
        'resetFailCount'  => $resetFailCount,
      ]);}

    //check entries against database
    include(app_path().'/members/passwordRequest/passwordRequestCheck.php');
    //adds to database if found above
    include(app_path().'/members/passwordRequest/passwordRequestProcess.php');
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
    $emailJob=(new passwordRequestSend($data));

    // dispatch job
    dispatch($emailJob)
    ->onQueue('emails');

    //send reply
    return response()
    ->json([
      'status'        => 'success',
      'resetRequest'  => $agtPswdReset,
    ]);

  }

  public function linkClick(){

    //process url & return $agentInfo
    include(app_path().'/members/passwordRequest/linkClick.php');

    //return view if $agentInfo valid
    return \Redirect::route('member.passwordChangeForm');
  }

}
