<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class multiUploadController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index(){
      return view('mdbxAdmin.fullPages.mdbxAdminOptions',[
         'showPanel'=>'uploadTest'
      ]);
   }

   public function process(){
      include(app_path().'/functions/uploadTesting/uploadProcess.php');
   }

   public function blob(){
      include(app_path().'/functions/uploadTesting/uploadBlob.php');
   }

}
