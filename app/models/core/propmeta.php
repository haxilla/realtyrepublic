<?php

namespace App\models\core;

class propmeta extends \App\Model
{

   protected $primaryKey   = 'propflyer_id';

   public static function zipmls(){
      return static::select('propflyer_id','mlsDir','zipDir')->get();
   }

   public static function findBySysID($formEntry){
      return static::select('propflyer_id','sk1')
      ->where('sysID','=',"$formEntry")
      ->get();
    }

    public static function synchSk1Count(){
      return $synchSk1Count=static::whereNull('sk1')
      ->orWhere('sk1','like','%'.'='.'%')
      ->count();
    }

    public static function fixSK1(){
      return $nullSK1=static::select('propflyer_id')
      ->whereNull('sk1')
      ->orWhere('sk1','like','%'.'='.'%')
      ->get();
    }
}
