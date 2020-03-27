<?php

namespace App\Http\Controllers\mdbxPublic;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class controllerTemplateController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:web');
   }


}
