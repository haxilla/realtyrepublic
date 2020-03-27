<?php

namespace App\models\core;

class agtoffice extends \App\Model
{
   protected $primaryKey = 'propagent_id';

   public function theAgent(){
      return $this->hasMany('App\models\core\propagent','id','propagent_id');
   }

   public function theAgentCleanup(){
      return $this->hasOne('App\models\core\propagentcleanup','propagent_id','propagent_id');
   }

   /* example of fillables
   protected $fillable = array(
      'propagent_id',
      'officeID',
      'eidx',
      'officeName',
      'officeAddress',
      'officeCity',
      'officeState',
      'officeZip',
      'officeBroker',
      'officePhone'
   );
   */
}
