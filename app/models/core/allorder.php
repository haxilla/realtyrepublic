<?php

namespace App\models\core;

class allorder extends \App\Model
{

   protected $table='allorders';
   //paypal has weird payment_date field
   //protected $dates = ['payment_date'];
   
   public static function testPurchases(){
      $testPurchases=static::select(
         'created_at','id','propagent_id','payer_email')
      ->where('test_ipn','=','1')
      ->get();
      return $testPurchases;
   }
}
