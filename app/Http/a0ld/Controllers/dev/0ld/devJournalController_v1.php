<?php

namespace App\Http\Controllers\dev\0ld;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\models\admin\adminOption;
use App\models\admin\adminTable;
use App\models\dev\devtask;
use App\models\dev\devtip;
use App\models\dev\devexcuse;
use App\models\dev\devtaskcomment;
use App\models\dev\masterVersion;
use Auth;
use Request;

class devJournalController_v1 extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index(){
      
      //get tasks
      include(app_path().'/devJournal/queries/allTasks.php');

      //send to view
      return view('dev.fullpages.devIndex',[
         'activeTasks'     => $activeTasks,
         'completeTasks'   => $completeTasks,
      ]);

   }

   public function newTaskPost(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }

      $taskDesc=request('taskDesc');
      $adminID=Auth::guard('admin')->user()->id;
      //set Version
      $versionID=masterVersion::orderBy('id','desc')
      ->pluck('versionID')
      ->first();
      //set authLevel
      $adminInfo=adminTable::select('authLevel')
      ->where('id','=',"$adminID")
      ->first();
      $authLevel=$adminInfo['authLevel'];

      devtask::create([
         'taskDesc'     => $taskDesc,
         'adminID'      => $adminID,
         'lastComment'  => \Carbon\Carbon::now(),
         'versionID'    => $versionID,
         'authLevel'    => $authLevel,
         'taskFlag'     => 1
      ]);

      return \Redirect::route("dev.journal",[
         'taskType'=>'new',
      ]);

   }

   public function taskCommentSort(){
      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}
      }
      //get variables
      $taskID=request('taskID');
      $sort=request('sort');
      //run query
      devtask::where('taskID','=',"$taskID")
      ->update([
         'commentSort'=>$sort,
      ]);
      //redirect
      return back();
   }

   public function unflagComment(){

      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}}

      $commentID=request('commentID');
      devtaskcomment::where('commentID','=',"$commentID")
      ->update([
         'commentFlag'=>0
      ]);
      return back();
   }

   public function unflagAll(){
      $journalMode=adminOption::where('adminID','=','1')
      ->pluck('journalMode')
      ->first();

      if($journalMode==='LIVE'||!$journalMode){
         $url=url::current();
         if (strpos($url, '.test') !== false){
            dd('use LIVE journal');}}

      $taskID=request('taskID');
      devtaskcomment::where('taskID','=',"$taskID")
      ->update([
         'commentFlag'=>0
      ]);
      return back();
   }

   public function noPageYet(){
      //meant for productivity analysis
      //group dates and count
      $allTasksGroup=devtask::select(
         \DB::raw('DATE(created_at) as date'),
         \DB::raw('count(*) as theCount')
      )
      ->whereDate('created_at','>',"2018-07-23")
      ->groupBy('date')
      ->get();

      //group dates and count
      $completeTasksGroup=devtask::select(
         \DB::raw('DATE(taskComplete) as date'),
         \DB::raw('count(*) as theCount')
      )
      ->whereNotNull('taskComplete')
      ->whereDate('taskComplete','>',"2018-07-23")
      ->groupBy('date')
      ->get();

   }

   public function versionChangePost(Request $request){

      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}
      //get versionID
      $versionID=request('versionID');
      $versionDesc=request('versionDesc');
      //validate
      $validator = \Validator::make($request::all(), [
         'versionID'      => 'min:6|required',
      ]);

      if (!$validator->passes()){
         //back to form with errors
         return back()->withInput()->withErrors($validator);}

      //get all tasks that NOT complete and update version #
      devtask::whereNull('taskComplete')
      ->update([
         'versionID'=>$versionID
      ]);
      //update versionID in masterVersion
      masterVersion::create([
         'versionID'    => $versionID,
         'versionDesc'  => $versionDesc,
         'microVersion' => $versionID,
      ]);

      //redirect back
      return \Redirect::route("admin.adminOptions",[
         'showPanel'=>'version',
      ])->with('message', "Version Changed Successfully!");

   }

}
