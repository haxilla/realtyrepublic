<?php

namespace App\models\distro;

class remDistroCheck extends \App\Model
{
   protected $table = 'remdistro.remDistroChecks';
   protected $primaryKey = 'theEmail';
   public $incrementing = false;
}
