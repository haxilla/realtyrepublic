<?php

namespace App\adre\models;

class adreEntityBackup extends \App\Model
{
   protected $table = 'adre.ADRE_entities_backup';
   protected $primaryKey = 'LicNumber'; // or null
   public $incrementing = false;
}
