<?php

namespace App\Http\Controllers\mdbxMember;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\core\propstyle;

class colorsController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:member');
   }

   public function store($id,$section,$color){

      include(app_path() . '/functions/mdbx/mdbxColorQuery.php');

   }
}
