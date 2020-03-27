<?php

namespace App\models\core;

class propagentmeta extends \App\Model
{
   protected $primaryKey   = 'propagent_id';

   public function theAgent(){
      return $this->hasOne('App\models\core\propagent','id','propagent_id');
   }

}
