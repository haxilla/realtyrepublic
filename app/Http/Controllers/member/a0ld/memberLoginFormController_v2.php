<?php

namespace App\Http\Controllers\member\a0ld;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class memberLoginFormController_v2 extends Controller
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

    //ajax
    /*
    return response()
    ->json([
      'status'=>'newLogin',
      'url'   =>$url,
    ]);
    */

  }

  public function loginSubmit(Request $request){

    //route requested
    $gotoURL=request('gotoURL');

    //check auth
    include(app_path().'/members/functions/authorizationLogic.php');

    //validation Errors
    if($validationErrors){
      return redirect()->route('public.index')
      ->withInput()
      ->withErrors($validator)
      ->with('url',$gotoURL);
    }

    //login attempted & failed
    if($loginFail){
      return redirect()->route('public.index')
      ->with('msg','loginFail')
      ->with('url',$gotoURL);
    }

    if($loginOK){
      return redirect($gotoURL);
    }

    dd('error-line62-memberLoginFormController');
    /*
    // ajax errors
    if($validationErrors){
      return response()
      ->json([
        'errors'=>$validator->errors()->all(),
      ]);
    }
    */

    /*
    // ajax loginFail
    if($loginFail){
      //attempt failed
      return response()
      ->json([
        'status'=>'loginFail',
      ]);}
    */
    //new login needed
    // ajax newLogin
    /*
      return response()
      ->json([
        'status'=>'newLogin',
        'url'   =>$url,
      ]);}
    */
    /*
    if($loginOK){
      return redirect()
      ->intended(route('member.dashboard'));
    }
    */
    /*
    // ajax loginOK
    if($loginOK){
      //new window
      $currentURL=url()->current();
      //json reply
      return response()
      ->json([
        'status'  => 'authenticated',
        'id'      => Auth::guard('member')->id(),
        'adminID' => Auth::guard('admin')->id(),
        'url'     => $currentURL,
      ]);}
      */
  }

}
