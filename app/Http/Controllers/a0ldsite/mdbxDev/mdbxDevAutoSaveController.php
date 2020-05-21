<?php

namespace App\Http\Controllers\mdbxDev;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\models\dev\devtask;
use App\models\dev\devtaskcomment;
use App\models\dev\devtaskmeta;
class mdbxDevAutoSaveController extends Controller
{
   public function __construct(){
      $this->middleware('auth:admin');
   }

   public function autoSaveTask(){

      $taskID=request('taskID');
      $taskDesc=request('taskDesc');
      if(!$taskID){
         dd('error-line179-devJournalController');}

      devtask::where('taskID','=',"$taskID")
      ->update([
         'taskDesc'=>$taskDesc,
         'lastEdit'=>\Carbon\Carbon::now(),
      ]);
   }

   public function autoSaveComment(){

      $commentID=request('commentID');
      $taskComment=request('taskComment');
      if(!$commentID){
         dd('error-line197-devJournalController');}

      devtaskcomment::where('commentID','=',"$commentID")
      ->update([
         'taskComment'=>$taskComment,
         'lastEdit'=>\Carbon\Carbon::now(),
      ]);
   }

   public function autoSaveTaskType(){

      $taskID=request('taskID');
      $taskType=request('taskType');
      if(!$taskID){
         dd('error-line212-devJournalController');}

      devtask::where('taskID','=',"$taskID")
      ->update([
         'taskType'=>$taskType,
         'lastEdit'=>\Carbon\Carbon::now(),
      ]);
   }

   public function autoSaveWizard(){

      $taskID=request('wizardID');
      if(!$taskID){
         dd('error-line212-devJournalController');}

      $routeName=request('routeName');
      $controllerName=request('controllerName');
      $viewName=request('viewName');
      $modelName=request('modelName');
      $modelPath=request('modelPath');
      $modelFunction=request('modelFunction');

      $dup=devtaskmeta::where('taskID','=',"$taskID")
      ->first();

      if($dup){
         devtaskmeta::where('taskID','=',"$taskID")
         ->update([
            'taskID'=>$taskID,
            'routeName'=>$routeName,
            'controllerName'=>$controllerName,
            'viewName'=>$viewName,
            'modelName'=>$modelName,
            'modelPath'=>$modelPath,
            'modelFunction'=>$modelFunction,
         ]);
      }else{
         devtaskmeta::create([
            'taskID'=>$taskID,
            'routeName'=>$routeName,
            'controllerName'=>$controllerName,
            'viewName'=>$viewName,
            'modelName'=>$modelName,
            'modelPath'=>$modelPath,
            'modelFunction'=>$modelFunction,
         ]);
      }
   }

   public function autoSavePriority(){
      $taskID=request('taskID');
      $addPriority=request('addPriority');
      if(!$taskID||!isset($addPriority)){
         dd('error-line102-mdbxDevAutoSaveController');}

      devtask::where('taskID','=',"$taskID")
      ->update([
         'taskPriority'=>$addPriority,
      ]);

      if($addPriority==1){
         devtask::where('taskID','=',"$taskID")
         ->update([
            'lastComment'=>\Carbon\Carbon::now(),
         ]);}

   }
}
