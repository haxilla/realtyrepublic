<?php

namespace App\models\oldsite;

class oldEmailRemoval extends \App\Model
{
   //realtyemails.com
   public $timestamps=false;
   protected $connection = 'oldsite';
   protected $table='emailremovals';
}
