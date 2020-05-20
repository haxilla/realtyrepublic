<?php

namespace App\devJournal\models;

class devtask extends \App\Model
{
   protected $table = 'remdev.devtasks';
   protected $primaryKey='taskID';
   protected $dates=['created_at','taskComplete','lastComment','snoozeDate'];

   public function taskDetails(){
      return $this->hasMany('App\devJournal\models\devtaskdetail','taskID','taskID');
   }

   public function taskComments(){
      return $this->hasMany('App\devJournal\models\devtaskcomment','taskID','taskID');
   }

   public function taskSteps(){
      return $this->hasMany('App\devJournal\models\devtaskstep','taskID','taskID');
   }

   public function adminInfo(){
      return $this->hasOne('App\models\admin\adminTable','id','adminID');
   }

   public static function currentVersionList(){
      $getVersion=\App\devJournal\models\masterVersion::orderBy('id','desc')
      ->first();

      $versionID=$getVersion['versionID'];

      $currentVersionList=static::where('versionID','=',"$versionID")
      ->whereNotNull('taskComplete')
      ->orderBy('versionTag','desc')
      ->get();

      return $currentVersionList;
   }

   public static function activeTaskCount(){
      $allActiveTasks=static::whereNull('taskComplete')
      ->count();
   }

   public static function allActiveTasks(){
      $allActiveTasks=static::whereNull('taskComplete')
      ->with('metas')
      ->get();
      //dd($allActiveTasks->where('taskID','=',"326")->first()->metas->routeName);
      return $allActiveTasks;
   }

   public static function allCompleteTasks(){
      $allCompleteTasks=static::whereNotNull('taskComplete')
      ->get();

      return $allCompleteTasks;
   }

   public static function priorityTaskCount(){
      $priorityTaskCount=devtask::whereNull('taskComplete')
      ->where('taskPriority','>','0')
      ->count();

      return $priorityTaskCount;
   }

}
