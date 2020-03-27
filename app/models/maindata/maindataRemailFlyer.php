<?php

namespace App\models\maindata;

class maindataRemailFlyer extends \App\Model
{
   //set table
   protected $table='maindata.remailflyers';
   //passing dates here will allow carbon functions in output
   protected $dates = [
      'creationDate','xLastDeliveryDate',
      'created_at','startDate','updated_at'
   ];

}
