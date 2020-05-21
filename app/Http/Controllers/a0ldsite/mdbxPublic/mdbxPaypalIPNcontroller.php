<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class mdbxPaypalIPNcontroller extends Controller
{
   public function ipnListen(Request $request){

      include(app_path().'/mdbxPaypal/mdbxIPNsimple.php');

   }
}
