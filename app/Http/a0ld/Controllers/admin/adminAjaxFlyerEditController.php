<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class adminAjaxFlyerEditController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function formPost(){
      return response()->json(['status'=>'Success']);
   }

}
