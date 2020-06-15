<?php

//this model is for campaigns that have not been completed
//during delivery it uses this table, but upon completion
//its inserted into regular propdeliv table and deleted
//from this table
namespace App\models\core;

class propdelivnow_v1 extends \App\Model
{
   protected $table        = 'propdelivnow';
   protected $dates        = ['emRequest','emStart','emComplete','created_at',
                              'updated_at','campCreated'];
   protected $primaryKey   = 'cid';

   public static function currentCampCount(){
      //count only for schedule count panel
      $currentCampCount=static::select(
         'propflyer_id','propagent_id','emRequest','campLabel',
         'authorized','emStart','cid','emArea','emArea_display',
         'emSubject','authorized')
      ->whereNotNull('emRequest')
      ->whereNull('emComplete')
      ->orderBy('emRequest')
      ->groupBy('propflyer_id')
      ->count();
      return $currentCampCount;
   }

   public static function authorizedCount(){
      $authorizedQuery=static::select('propflyer_id')
      ->whereNotNull('emRequest')
      ->whereNull('emComplete')
      ->where('authorized','=','1')
      ->count();
      return $authorizedQuery;
   }

   public static function unauthorizedCount(){
      $unauthorizedQuery=static::select('propflyer_id')
      ->whereNotNull('emRequest')
      ->whereNull('emComplete')
      ->where('authorized','!=','1')
      ->count();
      return $unauthorizedQuery;
   }

   public function theAgent(){
      return $this->belongsTo('App\models\core\propagent','propagent_id','id')
      ->select(array('id','agtFullName'));
   }
   public function theFlyer(){
      return $this->belongsTo('App\models\core\propflyer','propflyer_id','id')
      ->select(array('id','propagent_id','xFullStreet'));
   }
   public function theMeta(){
      return $this->hasOne('App\models\core\propmeta','propflyer_id','propflyer_id')
      ->select(array('propflyer_id','sk1'));
   }
   public static function thisDelivNowCount(){
      return static::count();
   }

}

/* can use below to map and show each area per flyer
/* was originally right below currentCampsQuery
/* inside currentCamps Function
/* currentCampsQuery had get() not count()
*************************************************
//mapped fields -- original query
$currentCampsMap = $currentCampsQuery->map(function ($item) {
    return [
      'authorized'   => $item->authorized,
      'campLabel'    => $item->campLabel,
      'propflyer_id' => $item->propflyer_id,
      'emSubject'    => $item->emSubject,
      'emArea'       => $item->emArea,
      'emStart'      => $item->emStart,
      'emRequest'    => $item->emRequest,
      'cid'          => $item->cid,
    ];
});
//groupBy propflyer_id
$grouped=$currentCampsMap->groupBy('propflyer_id');

return $grouped;
*/

/***   EXAMPLE OF OUTPUTTING MAPPED QUERY
*****************************************
foreach($grouped as $the){
   echo $the[0]['propflyer_id'].'<br>';
   foreach($the as $t){
      echo $t['emArea'].'<br>';
   }
   echo '<BR>';
}
***/

