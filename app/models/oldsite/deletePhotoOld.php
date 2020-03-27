<?php

namespace App\models\oldsite;

class deletePhotoOld extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table='remailphotodeletes';
   protected $primaryKey = 'ufid';
   public $timestamps = false;
}
