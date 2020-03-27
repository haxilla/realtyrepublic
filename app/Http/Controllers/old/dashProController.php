<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\propagent;
use Auth;

class dashProController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }

   public function dashCreateNew(){

      $umid=Auth::guard('web')->user()->id;
      $agentInfo=propagent::where('id','=',$umid)
      ->first();

      return view('members.includes.dashboard.dashCreateNew',[
         'agentInfo' => $agentInfo
      ]);

   }

}

