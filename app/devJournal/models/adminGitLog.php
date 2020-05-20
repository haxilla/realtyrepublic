<?php

namespace App\devJournal\models;

class adminGitLog extends \App\Model
{
   protected $table = 'remdev.adminGitLog';
   protected $dates = ['lastPull','lastPush'];

   public static function gitPullInfo(){
      $gitPullInfo=static::select('lastPull','microVersion')
      ->orderBy('id','desc')
      ->whereNotNull('lastPull')
      ->first();

      return $gitPullInfo;
   }

   public static function gitPushInfo(){
      $gitPushInfo=static::select('lastPush','microVersion')
      ->orderBy('id','desc')
      ->whereNotNull('lastPush')
      ->first();

      return $gitPushInfo;
   }
}
