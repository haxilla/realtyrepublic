<?php

namespace App\models\oldsite;

class oldetrack2019 extends \App\Model
{
   //realtyemails.com
   protected $connection = 'oldsite';
   protected $table ='emailgroups.etrack2019';
   protected $primaryKey = 'etrackid';
   protected $dates = ['etrackdate'];

}

