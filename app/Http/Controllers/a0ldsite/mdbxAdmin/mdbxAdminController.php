<?php

namespace App\Http\Controllers\mdbxAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class mdbxAdminController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function logout(){
      Auth::guard('admin')->logout();
      return \Redirect::route("admin.login");
   }

   public function index(){
      //return view('admin.adminIndex');
      return view('adminTest.index');
   }
}
