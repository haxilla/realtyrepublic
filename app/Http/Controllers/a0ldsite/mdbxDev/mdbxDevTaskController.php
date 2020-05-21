<?php

namespace App\Http\Controllers\mdbxDev;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\models\dev\devtask;
use App\models\dev\devtip;
use App\models\dev\devexcuse;
use App\models\dev\devtaskcomment;
use App\models\dev\masterVersion;
use App\models\admin\adminOption;
use Auth;

class mdbxDevTaskController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function taskDelete(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

      $taskID=request('taskID');
      devtask::destroy($taskID);
      return back();
   }

   public function taskComplete(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

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
         'taskFlag'=>0,
         'taskPriority'=>0,
      ]);

      return back();
   }

   public function markTip(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

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

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

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

   public function taskCommentPost(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

      $taskID=request('taskID');
      $listRef=request('listRef');
      $devTaskComment=request('devTaskComment');
      $adminID=Auth::guard('admin')->user()->id;

      //variable model
      $appPrefix = 'App\\models\\dev';
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
         'versionID'    => $versionID,
         'commentFlag'  => 1
      ]);
      //unflag new task after first comment
      devtask::where('taskID','=',"$taskID")
      ->update([
         'taskFlag'=>0
      ]);

      return back();
   }

   public function deleteTaskComment(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

      $commentID=request('commentID');
      devtaskcomment::destroy($commentID);
      return back();

   }

}
