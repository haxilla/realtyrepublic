<?php

namespace App\models\autosynch\etrack;

class etrackOld extends \App\Model
{

   protected $connection = 'oldsite';
   protected $table ='emailgroups.etrack2019';
   protected $primaryKey = 'etrackid';
   protected $dates = ['etrackdate'];

}