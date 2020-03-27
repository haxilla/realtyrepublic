<?php

namespace App\models\adre;

class adreNoMatch extends \App\Model
{
   protected $table        = 'adre.adreNoMatch';
   protected $primaryKey   = 'LicNumber'; // or null
   public $incrementing    = false;
   protected $dates        = ['noMatchDate'];

}
