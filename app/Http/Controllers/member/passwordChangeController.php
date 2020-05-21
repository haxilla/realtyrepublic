<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class passwordChangeController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:member');
  }


  public function passwordChangeForm(){

    //get umidLogic
    include(app_path().'/members/auth/umidLogic.php');

    //prlMatchLogic
    include(app_path().'/members/passwordRequest/prlMatchLogic.php');

    //return view
    return view('member.passwordChangeForm',[
      'agentInfo'     => $agentInfo,
      'agtUname'      => $agtUname,
      'expiredAt'     => $expiredAt,
      'prl'           => $prl,
    ]);

  }

  public function passwordChangeSubmit(Request $request){

    //form logic
    //return umid
    include(app_path().'/members/passwordRequest/passwordChangeLogic.php');

    //validation errors
    if($validator->fails()){
      return response()
      ->json([
        'status'  => 'Validation Errors',
        'errors'  => $validator->errors()->all(),
      ]);}

    //perform change in database
    include(app_path().'/members/passwordRequest/passwordChangeUpdate.php');

    //return success
    return response()
    ->json([
      'status'  =>  'success'
    ]);

  }

}
