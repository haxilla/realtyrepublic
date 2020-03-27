<?php

namespace App\Http\Controllers\mdbxDev;
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

class mdbxDevJournalController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      //check for variables
      $taskID=request('taskID');
      $listRef=request('listRef');
      $showComplete=request('showComplete');
      $taskType=request('taskType');
      $taskPriority=request('taskPriority');

      //if any are sent show the single record view
      if($listRef && $taskID){
         //set devtask for single taskID
         $singleRecord=devtask::with('taskComments')
         ->where('taskID','=',"$taskID")
         ->get();
         //set if present
         if($singleRecord->first()){
            $taskDesc=$singleRecord[0]->taskDesc;}

         //keep going if now
         //try devtip
         if(!$singleRecord->first()){
            $singleRecord=devtip::with('taskComments')
            ->where('taskID','=',"$taskID")
            ->get();
            if($singleRecord->first())
               $taskDesc=$singleRecord[0]->tipDesc;}

         //try devexcuse
         if(!$singleRecord->first()){
            $singleRecord=devexcuse::with('taskComments')
            ->where('taskID','=',"$taskID")
            ->get();
            if($singleRecord->first())
               $taskDesc=$singleRecord[0]->excuseDesc;}

         return view('mdbxDev.fullPages.mdbxJournal',[
            'singleRecordQuery' => $singleRecord,
            'taskID'            => $taskID,
            'listRef'           => $listRef,
            'taskType'          => $taskType,
            'singleRecord'      => 1,
         ]);
      }

      return view('mdbxDev.fullPages.mdbxJournal',[
         'taskID'       => $taskID,
         'listRef'      => $listRef,
         'taskType'     => $taskType,
         'singleRecord' => 0,
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
