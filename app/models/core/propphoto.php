<?php

namespace App\models\core;

class propphoto extends \App\Model
{

   protected $primaryKey = 'photoID';
   protected $dates = ['existCheck','photoDate'];

   public function theMeta(){
     return $this
     ->hasOne('App\models\core\propmeta','propflyer_id','propflyer_id');
   }

   public function theAgent(){
     return $this
     ->belongsTo('App\models\core\propagent','propagent_id','id');
   }


}
