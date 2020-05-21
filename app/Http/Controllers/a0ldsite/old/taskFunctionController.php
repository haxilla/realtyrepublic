<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\devtask;
use App\devtip;
use App\devexcuse;
use App\devtaskcomment;
use App\masterVersion;
use Auth;

class taskFunctionController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function delete(){
      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

      $taskID=request('taskID');
      devtask::destroy($taskID);
      return back();
   }

   public function taskComplete(){

      $url=url::current();

      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

      $taskID=request('taskID');
      $adminID=Auth::guard('admin')->user()->id;
      $currentVersion=masterVersion::orderBy('id','desc')
      ->first();

      $versionID=$currentVersion['versionID'];
      $versionCount=$currentVersion['versionCount'];
      $newCount=$versionCount+1;

      $versionTag=$versionID.$versionCount.$taskID;
      //update the version count
      masterVersion::where('versionID','=',"$versionID")
      ->update([
         'versionCount'=>$newCount,
         'microVersion'=>$versionTag,
         'lastGitPush'=>null,
         'lastGitPull'=>null
      ]);

      devtask::where('taskID','=',"$taskID")
      ->update([
         'taskComplete'=>\Carbon\Carbon::now(),
         'completedBy'=>$adminID,
         'versionTag'=>$versionTag,
      ]);
      return back();
   }

   public function markTip(){
      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

      $taskID=request('taskID');
      $adminID=Auth::guard('admin')->user()->id;

      $getTask=devtask::select(
         'taskDesc','adminID','lastComment','versionID'
      )
      ->where('taskID','=',"$taskID")
      ->first();
      $taskDesc=$getTask['taskDesc'];
      $lastComment=$getTask['lastComment'];
      $taskAdminID=$getTask['adminID'];
      $versionID=$getTask['versionID'];

      devtip::create([
         'tipDesc'=>$taskDesc,
         'taskID'=>$taskID,
         'adminID'=>$taskAdminID,
         'markedBy'=>$adminID,
         'versionID'=>$versionID,
         'lastComment'=>$lastComment,
      ]);

      devtask::destroy($taskID);
      return back();
   }

   public function makeExcuse(){
      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

      $taskID=request('taskID');
      $adminID=Auth::guard('admin')->user()->id;

      $getTask=devtask::select(
         'taskDesc','adminID','lastComment','versionID'
      )
      ->where('taskID','=',"$taskID")
      ->first();

      $taskDesc=$getTask['taskDesc'];
      $taskAdminID=$getTask['adminID'];
      $lastComment=$getTask['lastComment'];
      $versionID=$getTask['versionID'];

      devexcuse::create([
         'excuseDesc'   =>$taskDesc,
         'taskID'       =>$taskID,
         'markedBy'     =>$adminID,
         'adminID'      =>$taskAdminID,
         'lastComment'  =>$lastComment,
         'versionID'    =>$versionID
      ]);

      devtask::destroy($taskID);
      return back();
   }

   public function taskComment(){
      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

      $taskID=request('taskID');
      $listRef=request('listRef');
      $devTaskComment=request('devTaskComment');
      $adminID=Auth::guard('admin')->user()->id;

      //variable model
      $appPrefix = 'App';
      $theModel=$appPrefix.'\\'.$listRef;
      //update variable model
      $theModel::where('taskID','=',"$taskID")
      ->update([
         'lastComment'=>\Carbon\Carbon::now(),
      ]);

      $versionID=masterVersion::orderBy('id','desc')
      ->pluck('versionID')
      ->first();

      //insert comment
      devtaskcomment::create([
         'taskID'       => $taskID,
         'adminID'      => $adminID,
         'taskComment'  => $devTaskComment,
         'versionID'    => $versionID
      ]);
      return back();
   }

   public function showDevTask(){
      $taskID=request('taskID');
      //is it devtask,devtaskcomment,devtip,devexcuse?
      $listRef=request('listRef');

      return \Redirect::route('devJournal',[
         'taskID'=>$taskID,
         'listRef'=>$listRef,
      ]);

   }
}
