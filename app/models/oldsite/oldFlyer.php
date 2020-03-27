<?php

namespace App\models\oldsite;

class oldFlyer extends \App\Model
{
   //realtyemails.com
   public $timestamps=false;
   protected $connection = 'oldsite';
   protected $table='remailflyers';
   protected $primaryKey = 'ufid';
}
