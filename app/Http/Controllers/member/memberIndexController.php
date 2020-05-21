<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Auth;

class memberIndexController extends Controller
{

  public function __construct()
  {
     $this->middleware('auth:member');
  }

  public function memberIndex(){

    return redirect()->route('member.dashboard');

  }

  public function memberDashboard(){
    //umidLogic
    include(app_path().'/members/auth/umidLogic.php');
    //return view
    return view('member.dashboard',[
      'agentInfo'=>$agentInfo,
    ]);
  }

  public function memberLogout(){

    auth()->guard('member')->logout();
    return redirect()->route('public.index');

  }

  public function testRoute(){
    dd('all good');
  }

}
