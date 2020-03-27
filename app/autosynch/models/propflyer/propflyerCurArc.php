<?php

namespace App\autosynch\models\propflyer;

class propflyerCurArc extends \App\Model
{

   protected $table = 'remarchives.remailflyersmaster';
   protected $primaryKey = 'ufid';
   public $timestamps = false;

}