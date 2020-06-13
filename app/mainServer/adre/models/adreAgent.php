<?php

namespace App\adre\models;

class adreAgent extends \App\Model
{
   protected $table        = 'adre.ADRE_agents';
   protected $primaryKey   = 'LicNumber'; // or null
   public $incrementing    = false;
   //protected $dates        = ['originalDate','expireDate','lastModified'];

}
