<?php

namespace App\models\oldsite;

class oldPhoto extends \App\Model
{
   public $timestamps = false;
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table='remailphotos';
   protected $primaryKey = 'photoID';

   public static function oldPhotoCount(){
      return static::count();
   }

}
