<?php

namespace App\models\adre;

class adreEntity extends \App\Model
{
   protected $table = 'adre.adreentities';
   protected $primaryKey = 'LicNumber'; // or null
   public $incrementing = false;
}
