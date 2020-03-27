<?php

namespace App\models\oldsite;

class oldStyle extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table='remailstyles';
   protected $primaryKey = 'ufid';

   public static function oldStyleCount(){
      return static::count();
   }

}
