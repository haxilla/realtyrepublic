<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\propagent;

class dashNewFlyerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function create(){

      $umid=Auth::guard('web')->user()->id;

      $agentInfo=propagent::where('id','=',"$umid")
      ->first();

      return view('members.includes.dashboard.dashCreateNew',[
         'agentInfo'=>$agentInfo
      ]);

   }
}
