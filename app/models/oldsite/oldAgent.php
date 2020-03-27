<?php

namespace App\models\oldsite;

class oldAgent extends \App\Model
{
   //realtyemails.com
   public $timestamps = false;
   protected $connection = 'oldsite';
   protected $table='emailagents';
   protected $primaryKey = 'umid';
   protected $dates=['last_login','agtPhotoCheck','agtLogoCheck'];

   public static function oldAgentCount(){
      return static::count();
   }

}
