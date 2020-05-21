<?php

namespace App\Http\Controllers\mdbxAdmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class adminArchiveController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function archiveFlyerPhoto(){
      \DB::select( \DB::raw("
         REPLACE into mdbxArchive.archiveFlyerPhoto
         select * from propphotos
      "));
   }

}
