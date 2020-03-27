<?php

namespace App\models\oldsite;

class deleteFlyerOld extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table='remailflyerdeletes';
   protected $primaryKey = 'ufid';
   public $timestamps = false;


}
