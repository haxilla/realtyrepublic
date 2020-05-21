<?php

namespace App\Http\Controllers\dev;
use App\Http\Controllers\Controller;
use App\models\admin\adminTable;
use Auth;

class taskController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

   public function index(){
      //get adminID
      $adminID=Auth::guard('admin')->user()->id;
      //get authLevel
      $adminInfo=adminTable::where('id','=',$adminID)
      ->select('authLevel')
      ->first();
      $authLevel=$adminInfo['authLevel'];
      
      //get url vars
      $taskstatus=request('taskstatus');
      $sectionFilter=request('sectionFilter');
      $filter=request('filter');

      //set taskDisplay
      if(!$taskstatus){
         $taskstatus="Active";
         $taskDisplay="Active";
      }elseif($taskstatus=="Tips"){
         $taskDisplay="Tips";
      }elseif($taskstatus=="Excuses"){
         $taskDisplay="Excuses";
      }else{
         $taskDisplay=$taskstatus;}

      //get tasks
      include(app_path().'/devJournal/queries/allTasks.php');

      //send to view
      return view('dev.fullpages.devIndex',[
         'taskquery'       => $taskquery,
         'taskstatus'      => $taskstatus,
         'taskDisplay'     => $taskDisplay,
         'sectionFilter'   => $sectionFilter,
         'filter'          => $filter,
      ]);
   }

   public function taskAjax(){
      //set adminID
      $adminID=Auth::guard('admin')->user()->id;
      //set authLevel
      $adminInfo=adminTable::where('id','=',$adminID)
      ->select('authLevel')
      ->first();
      $authLevel=$adminInfo['authLevel'];
      //include
      //returns JSON values
      include(app_path().'/devJournal/functions/taskAjax.php');
   }

   public function taskResultLink(){
      //get URL variables
      $taskID=request('taskID');
      $listRef=request('listRef');
      //error if missing
      if(!$taskID||!$listRef){
         dd('error-line79-dev/taskController');}

      //retrieve taskquery from link
      include(app_path().'/devJournal/tasksearch/taskresultlink.php');

      $taskDisplay=$taskstatus;
      //send to view
      return view('dev.fullpages.devIndex',[
         'taskquery'       => $taskquery,
         'taskstatus'      => $taskstatus,
         'taskDisplay'     => $taskDisplay,
         'sectionFilter'   => null,
         'filter'          => null,
      ]);

   }

}
