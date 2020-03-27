<?php

namespace App\models\core;

class propoffice extends \App\Model
{
   public function theAgtOffice(){
     return $this
     ->hasMany('App\models\core\agtoffice','tempOfficeID','officeID');
   }
}
