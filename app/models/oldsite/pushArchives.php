<?php

namespace App\models\oldsite;

class pushArchives extends \App\Model
{
   //realtyemails.com
   public $timestamps=false;
   protected $connection = 'oldsite';
   protected $table='pusharchives';
   protected $primaryKey = 'ufid';
}
