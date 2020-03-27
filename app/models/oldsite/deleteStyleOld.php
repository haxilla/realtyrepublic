<?php

namespace App\models\oldsite;

class deleteStyleOld extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table='remailstyledeletes';
   protected $primaryKey = 'ufid';
   public $timestamps = false;

}
