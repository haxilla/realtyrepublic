<?php

namespace App\adre\models;

class adreEntity extends \App\Model
{
   protected $table = 'adre.ADRE_entities';
   protected $primaryKey = 'LicNumber'; // or null
   public $incrementing = false;
}
