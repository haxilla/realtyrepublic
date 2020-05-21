<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class agentAutoSearchController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function formVal(){
      //get value
      $formVal=request('formVal');
      //error if none
      if(!$formVal){
         dd('error-line18-agentAutoSearchController');}

      //find search criteria with formVal
      include(app_path().'/admin/autosearch/propagent.php');
   }

}
