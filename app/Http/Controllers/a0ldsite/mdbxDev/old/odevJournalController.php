<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Request;
use App\devtask;
use App\devtaskcomment;
use App\devtip;
use App\devexcuse;
use App\masterVersion;
use App\adminTable;
use Auth;

class devJournalController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function show(){
      /*
      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}
      */
      $taskID=request('taskID');
      $listRef=request('listRef');
      $showComplete=request('showComplete');

      $activeTasks=devtask::with('taskComments')
      ->with('adminInfo')
      ->whereNull('taskComplete')
      ->orderBy('lastComment','desc')->get();
      $taskDesc=null;

      if($listRef && $taskID){
         //set devtask for single taskID
         $activeTasks=devtask::with('taskComments')
         ->where('taskID','=',"$taskID")
         ->get();
         //set if present
         if($activeTasks->first()){
            $taskDesc=$activeTasks[0]->taskDesc;}

         //keep going if now
         //try devtip
         if(!$activeTasks->first()){
            $activeTasks=devtip::with('taskComments')
            ->where('taskID','=',"$taskID")
            ->get();
            if($activeTasks->first())
               $taskDesc=$activeTasks[0]->tipDesc;}

         //try devexcuse
         if(!$activeTasks->first()){
            $activeTasks=devexcuse::with('taskComments')
            ->where('taskID','=',"$taskID")
            ->get();
            if($activeTasks->first())
               $taskDesc=$activeTasks[0]->excuseDesc;}
      }

      $completes=devtask::whereNotNull('taskComplete')
      ->orderBy('taskComplete','desc');
      //using 1 master query and cloning
      $completeCount=clone $completes;
      $completeTasks=clone $completes;
      //setting other variables
      $completeCount=$completeCount->count();
      $completeTasks=$completeTasks
      ->paginate(3)
      ->appends(request()->query());

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

      $adminID=Auth::guard('admin')->user()->id;
      $adminInfo=adminTable::where('id','=',"$adminID")
      ->first();

      return view('dev.journal',[
         'activeTasks'        => $activeTasks,
         'completeCount'      => $completeCount,
         'completeTasks'      => $completeTasks,
         'showComplete'       => $showComplete,
         'allTasksGroup'      => $allTasksGroup,
         'completeTasksGroup' => $completeTasksGroup,
         'adminInfo'          => $adminInfo,
         'taskID'             => $taskID,
         'taskDesc'           => $taskDesc,
      ]);

   }

   public function newTaskPost(){

      $url=url::current();
      if (strpos($url, '.test') !== false){
         dd('use LIVE journal');}

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
         'authLevel'    => $authLevel
      ]);

      return \Redirect::route("devJournal");

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
         'versionID'    =>$versionID,
         'versionDesc'  =>$versionDesc
      ]);

      //redirect back
      return \Redirect::route("adminOptions",[
         'showPanel'=>'version',
      ])->with('message', "Version Changed Successfully!");

   }



   public function adminCommentSort(){
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

   public function adminDeleteTaskComment(){

      $commentID=request('commentID');
      devtaskcomment::destroy($commentID);
      return back();

   }

}
