<?php

namespace App\Http\Controllers\mdbxPublic;

use App\Http\Controllers\Controller;
use Request;
use Auth;

class mdbxPublicLoginController extends Controller
{

  public function login(Request $request){

    // get formfields
    $thePswd      = $request::input('password');
    $uName        = $request::input('agtUname');
    $rememberMe   = $request::input('rememberMe') ? true : false;
    $fromForm     = $request::input('fromForm');
    $loginOK      = NULL;

    //if fromForm has captcha in it require captcha validation
    if($fromForm=='loginCaptchaModal'){
      //require captcha check
      include(app_path().'/members/functions/requireValidCaptcha.php');
      //if captcha invalid redirect
      if(!$captchaPresent){
        return back()
        ->withErrors($validator)
        ->withInput()
        ->with('loginModalCaptchaError','Field Required');}}

    
    //if NOT authorized run script to log-in
    if(!Auth::guard('member')->check()){
      //returns umid, udpates lastLogin, gets paymentMode
      include(app_path().'/members/functions/authorizationLogic.php');
    }else{
      //logged in
      $loginOK=1;}

    //if login fails redirect
    if(!$loginOK){
      if(!$uName){
        $error="Must be Logged in to Access this Page!";
      }else{
        $error="Error with Login Credentials";}
      return redirect()->route('public.index')
      ->withErrors(['message'=>$error])
      ->withInput()
      ->with('loginModalError',$error);}

    // ***  get accountVariables -- 
    // ***  changePswd,agentInfo,accountInfo,activeCampaigns,completeCampaigns
    include(app_path().'/members/queries/accountInfo.php');

    //check if imports available
    include(app_path().'/members/functions/importCheck.php');

    //send to index page
    return view('member.memberIndex',[
      'umid'              => $umid,
      'key'               => null,         //used to determine where to redirect
      'agentInfo'         => $agentInfo,
      'importList'        => $importList,
      'unsentFlyers'      => $unsentFlyers,
      'activeCampaigns'   => $activeCampaigns,
      'completeCampaigns' => $completeCampaigns,
      'changePswd'        => $changePswd,
    ]);

  }

  public function logout(){
    auth()->guard('member')->logout();
    return redirect()->route('public.index');
  }

}
