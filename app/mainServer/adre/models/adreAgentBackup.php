<?php

namespace App\adre\models;

class adreAgentBackup extends \App\Model
{
   protected $table        = 'adre.ADRE_agents_backup';
   protected $primaryKey   = 'LicNumber'; // or null
   public $incrementing    = false;
   //protected $dates        = ['originalDate','expireDate','lastModified'];

}
