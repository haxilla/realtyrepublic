<?php

namespace App\models\admin;

class adminOption extends \App\Model
{
   protected $table = 'adminoptions';

   protected static function adminModes(){
      $adminModes=static::first();
      return $adminModes;
   }

}
