<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class memberLoginFormController extends Controller
{

  public function navbarLogin(){

    //get memberID
    $umid=Auth::guard('member')->id();

    //if none, not logged in
    if(!$umid){
      //return json response
      return response()
      ->json([
        'status'=>'loginRequired',
      ]);

    //found, logged in
    }else{
      //return json response
      return response()
      ->json([
        'status'=>'loginOK',
      ]);

    }
  }

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

  public function ajaxLoginSubmit(Request $request){

    //check auth
    include(app_path().'/members/auth/authLogic_conditional.php');

    //loginFieldsMissing
    if($loginFieldsMissing){
      return response()
      ->json([
        'errors'          => $validateLogin->errors()->all(),
        'failCount'       => $failCount,
        'captchaPresent'  => $captchaPresent,
        'gotoURL'         => $gotoURL,
      ]);}

    //captcha not checked
    if($captchaMissing){
      return response()
      ->json([
        'errors'          => $validateCaptcha->errors()->all(),
        'failCount'       => $failCount,
        'captchaPresent'  => $captchaPresent,
        'gotoURL'         => $gotoURL,
      ]);}

    //captcha box errors
    if($captchaError){
      //set errors
      $errors=['captchaError',];
      //send response
      return response()
      ->json([
        'errors'          => $errors,
        'failCount'       => $failCount,
        'captchaPresent'  => $captchaPresent,
        'gotoURL'         => $gotoURL,
      ]);}

    //login fail
    if($loginFail){
      //set errors
      $errors=['Invalid Username or Password',];
      //set failCount
      if(!$failCount){
        $failCount=1;
      }else{
        $failCount++;}
      //redirect out
      return response()
      ->json([
        'errors'    => $errors,
        'failCount' => $failCount,
        'gotoURL'   => $gotoURL,
      ]);}

    //success - redirect
    if($loginOK){
      return response()
      ->json([
        'status'    =>'success',
        'gotoURL'   =>$gotoURL,
      ]);}

  }

  public function loginSubmit(Request $request){

    //route requested
    $gotoURL=request('gotoURL');
    $failCount=request('failCount');
    $captchaPresent=request('captchaPresent');

    if(!$gotoURL){
      $gotoURL="/member/dashboard";}

    //check auth
    include(app_path().'/members/auth/authLogic_conditional.php');

    //validation Errors
    if($loginFieldsMissing){
      return redirect()->route('public.index')
      ->withInput()
      ->withErrors($validateLogin)
      ->with('failCount',$failCount)
      ->with('captchaPresent',$captchaPresent)
      ->with('url',$gotoURL);}

    //captcha not checked
    if($captchaMissing){
      return redirect()->route('public.index')
      ->withInput()
      ->withErrors($validateCaptcha)
      ->with('failCount',$failCount)
      ->with('captchaPresent',$captchaPresent)
      ->with('url',$gotoURL);}

    //error with captcha reply
    if($captchaError){
      return redirect()->route('public.index')
      ->withInput()
      ->with('failCount',$failCount)
      ->with('captchaPresent',$captchaPresent)
      ->with('msg','captchaError')
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
    dd('error-line175-memberLoginFormController');

  }

}
