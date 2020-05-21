<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mdbxAdminColorsController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function store($id,$section,$color){
      include(app_path() . '/functions/mdbx/mdbxColorQuery.php');
   }
}
