<?php

namespace App\Http\Controllers\thePublic;

use App\Http\Controllers\Controller;
use Request;
use Auth;

class publicLoginController extends Controller{

  public function login(Request $request){

    $loginOK      = NULL;
    $loginFail 		= NULL;

    //if NOT authorized run script to log-in
    if(!Auth::guard('member')->check()){

      //returns umid, udpates lastLogin, gets paymentMode
      include(app_path().'/members/functions/authorizationLogic.php');

    }else{

      //logged in
      $loginOK=1;

    }

    //login attempted & failed
    if($loginFail){
      //attempt failed
      return response()
      ->json([
        'status'=>'loginFail',
      ]);}

    //new login needed
    if(!$loginOK){
      //new window
      return response()
      ->json([
        'status'=>'newLogin',
      ]);}

    if($loginOK){
      //new window
      $currentURL=url()->current();
      //json reply
      return response()
      ->json([
        'status'  => 'loggedIn!',
        'id'      => Auth::guard('member')->id(),
        'adminID' => Auth::guard('admin')->id(),
        'url'     => $currentURL,
      ]);}

  }//end of login function

}//end of class
