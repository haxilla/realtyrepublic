<?php

namespace App\models\adre;

class adreAgent extends \App\Model
{
   protected $table        = 'adre.adreagents';
   protected $primaryKey   = 'LicNumber'; // or null
   public $incrementing    = false;
   //protected $dates        = ['originalDate','expireDate','lastModified'];

   //adreNoMatch relationship
   public function adreNoMatch(){
      return $this->hasOne('App\models\adre\adreNoMatch','LicNumber','LicNumber');
   }

}
