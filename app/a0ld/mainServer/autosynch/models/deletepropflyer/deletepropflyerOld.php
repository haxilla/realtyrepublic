<?php

namespace App\autosynch\models\deletepropflyer;

class deletepropflyerOld extends \App\Model
{

   protected $connection = 'oldsite';
   protected $table ='remailflyerdeletes';
   protected $primaryKey='ufid';
   public $timestamps=false;

}