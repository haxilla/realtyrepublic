<?php

namespace App\models\core;

class propstyle extends \App\Model
{
   protected $primaryKey   = 'propflyer_id';

   public static function thisStyleCount(){
      return static::count();
   }

}
