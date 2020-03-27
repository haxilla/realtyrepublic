<?php

namespace App\Http\Controllers\mdbxDev;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\dev\masterVersion;
use App\models\dev\adminGitLog;
use Auth;

class mdbxDevGitController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function markGitPush(){
      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      $id=request('id');
      $microVersion=masterVersion::where('id','=',"$id")
      ->pluck('microVersion')
      ->first();
      //update
      masterVersion::where('id','=',"$id")
      ->update([
         'lastGitPush'=>\Carbon\Carbon::now(),
      ]);
      //insert
      adminGitLog::create([
         'lastPush'=>\Carbon\Carbon::now(),
         'masterVersionID'=>$id,
         'adminID'=>$adminID,
         'microVersion'=>$microVersion
      ]);
      return back();
   }

   public function markGitPull(){
      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      $id=request('id');
      $microVersion=masterVersion::where('id','=',"$id")
      ->pluck('microVersion')
      ->first();
      //update
      masterVersion::where('id','=',"$id")
      ->update([
         'lastGitPull'=>\Carbon\Carbon::now(),
      ]);
      //insert
      adminGitLog::create([
         'lastPull'=>\Carbon\Carbon::now(),
         'masterVersionID'=>$id,
         'adminID'=>$adminID,
         'microVersion'=>$microVersion
      ]);
      return back();

   }
}
