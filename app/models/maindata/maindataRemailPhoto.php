<?php

namespace App\models\maindata;

class maindataRemailPhoto extends \App\Model
{

   public $timestamps=false;
   protected $primaryKey='photoID';
   protected $table='maindata.remailphotos';
   //passing dates here will allow carbon functions in output
   protected $dates = ['photoDate','existCheck'];

   public function theFlyer(){
     return $this
     ->belongsTo('App\models\maindata\maindataRemailFlyer','ufid','ufid');
   }

   public function currentRecord(){
     return $this
     ->belongsTo('App\models\core\propphoto','photoID','photoID');
   }

   public function oldPhotoRecord(){
     return $this
     ->belongsTo('App\models\oldsite\oldPhoto','photoID','photoID');
   }

    public static function existCheckCount(){
      return static::whereNull('exist_check')
      ->where('photoDate','>','2018-06-15')
      ->count();
   }

}
