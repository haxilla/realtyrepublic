<?php

namespace App\Http\Controllers\member\a0ld;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class memberLoginFormController_v3 extends Controller
{

  public function loginForm(){

    //get intended route
    $url=\Session::get('url');

    //set default if none
    if(!$url){
      $url='https://www.remstage.test/login';}

    return redirect()->route('public.index')
    ->with('msg','loginRequired')
    ->with('url',$url);

  }

  public function loginSubmit(Request $request){

    //route requested
    $gotoURL=request('gotoURL');
    $failCount=request('failCount');

    //check auth
    include(app_path().'/members/auth/authorizationLogic.php');

    //validation Errors
    if($fieldsMissing){
      return redirect()->route('public.index')
      ->withInput()
      ->withErrors($validateAll)
      ->with('url',$gotoURL);}

    //captcha box not checked
    if($captchaError){
      return redirect()->route('public.index')
      ->withInput()
      ->with('msg','captchaErrror')
      ->with('url',$gotoURL);}

    if($loginFail){
      //set failCount
      if(!$failCount){
        $failCount=1;
      }else{
        $failCount++;}
      //redirect out
      return redirect()->route('public.index')
      ->withInput()
      ->with('msg','loginFail')
      ->with('failCount',$failCount)
      ->with('url',$gotoURL);}

    //credentials passed
    //user logged in
    if($loginOK){
      return redirect($gotoURL);}

    // should not be here
    // check authorizationLogic
    dd('error-line56-memberLoginFormController');

  }

}
