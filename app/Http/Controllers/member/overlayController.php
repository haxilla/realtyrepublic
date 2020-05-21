<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Request;
use Auth;

class overlayController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:member');
  }

  public function memberNav(){
    //get loggedInuser
    include(app_path().'/members/auth/getUmid.php');

    //get navLink
    $link=request('link');
    //error if none
    if(!$link){
      dd('error-line21-member/overlayController');}

    if($link=='Your Profile'){
      //Profile
      $html=\View::make('member.overlays.profileForm')
      ->with(['agentInfo'=>$agentInfo,])
      ->render();
      //echo & exit
      echo $html;
      exit();

    }else if($link=='Account Info'){
      //Account
      $html=\View::make('member.overlays.accountForm')
      ->with(['agentInfo'=>$agentInfo,])
      ->render();
      //echo & exit
      echo $html;
      exit();

    }else{
      //error if here
      dd('error-line30-member/overlayController');}

  }

}
