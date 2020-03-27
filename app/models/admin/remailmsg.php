<?php

namespace App\models\admin;

class remailmsg extends \App\Model
{
  protected $table='remailmsg';
  protected $primaryKey='msgid';
  protected $dates = ['msg_date','created_at','updated_at'];

  public static function memberMessages(){
    $messages=static::select(
      'msgid','propagent_id','propflyer_id',
      'msg','senderName','senderEmail','created_at'
    )
    ->whereNull('apprv')
    ->with(['theAgent'=>function($query){
      $query->select('id','agtFullName');
    }])
    ->with(['theFlyer'=>function($query){
      $query->select('id','xFullStreet');
    }])
    ->get();

    return $messages;
  }

  public function theAgent(){
    return $this->belongsTo('App\models\core\propagent','propagent_id','id');
  }

  public function theFlyer(){
    return $this->belongsTo('App\models\core\propflyer','propflyer_id','id');
  }
}
