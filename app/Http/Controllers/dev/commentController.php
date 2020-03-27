<?php

namespace App\Http\Controllers\dev;
use App\Http\Controllers\Controller;
use Auth;
use Request;

class commentController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function commentAjax(){
      
      //set adminID
      $adminID=Auth::guard('admin')->user()->id;
      //include addTaskComment
      //returns JSON values
      include(app_path().'/devJournal/functions/commentAjax.php');

   }

   public function linkAjax(Request $request){

      //set adminID
      $adminID=Auth::guard('admin')->user()->id;
      //include
      //returns JSON values
      include(app_path().'/devJournal/functions/linkAjax.php');
      
   }


   public function commentFlag(){

      //set adminID
      $adminID=Auth::guard('admin')->user()->id;

      //include flagComment
      include(app_path().'/devJournal/functions/commentFlag.php');

   }


}
