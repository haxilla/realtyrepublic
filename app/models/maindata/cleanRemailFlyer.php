<?php

namespace App\models\maindata;

class cleanRemailFlyer extends \App\Model
{
   //set table
   protected $table='maindata.cleanremailflyers';
   //passing dates here will allow carbon functions in output
   protected $dates = [
      'creationDate','xLastDeliveryDate',
      'created_at','startDate','updated_at'
   ];

}
