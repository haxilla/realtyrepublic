<?php

namespace App\Http\Controllers\member\a0ld;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class memberLoginFormController_v1 extends Controller
{

  public function loginForm(){

    return redirect()->route('public.index')
      ->with('msg','loginRequired');
    /*
    //for ajax
    return response()
    ->json([
      'status'=>'newLogin',
    ]);
    */

  }

  public function loginSubmit(Request $request){

    //check auth
    include(app_path().'/members/functions/authorizationLogic.php');

    //validation Errors
    if($validationErrors){
      return redirect()->route('public.index')
      ->withInput()
      ->withErrors($validator);
    }

    /* ajax errors
    if($validationErrors){
      return response()
      ->json([
        'errors'=>$validator->errors()->all(),
      ]);
    }
    */

    //login attempted & failed
    if($loginFail){
      return redirect()->route('public.index')
      ->with('msg','loginFail');
    }
    /* ajax loginFail
    if($loginFail){
      //attempt failed
      return response()
      ->json([
        'status'=>'loginFail',
      ]);}
    */

    //new login needed
    /* ajax newLogin
    if(!$loginOK){
      //new window
      return response()
      ->json([
        'status'=>'newLogin',
      ]);}
    */
    if($loginOK){
      return redirect()
      ->intended(route('member.dashboard'));
    }
    /* ajax loginOK
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
    */

  }

}
