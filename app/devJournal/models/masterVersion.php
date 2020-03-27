<?php

namespace App\devJournal\models;

class masterVersion extends \App\Model
{
   protected $table = 'remdev.masterVersion';

   public static function versionInfo(){
      $versionInfo=static::select('id','versionID','versionCount',
         'lastGitPush','lastGitPull')
      ->orderBy('id','desc')
      ->first();
      return $versionInfo;
   }

   public static function versionHistory(){
      $versionHistory=static::select('id','versionID','versionCount',
         'created_at','versionDesc')
      ->orderBy('id','desc')
      ->take(5)
      ->get();
      return $versionHistory;
   }

}
