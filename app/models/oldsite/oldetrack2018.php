<?php

namespace App\models\oldsite;

class oldetrack2018 extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table ='emailgroups.etrack2018';
   protected $primaryKey = 'etrackid';
   protected $dates = ['etrackdate'];

}

