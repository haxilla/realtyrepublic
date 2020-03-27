<?php

namespace App\models\oldsite;

class pushArchivesCopy extends \App\Model
{
   //realtyemails.com
   public $timestamps=false;
   protected $connection = 'oldsite';
   protected $table='pusharchivescopy';
   protected $primaryKey = 'ufid';
}
