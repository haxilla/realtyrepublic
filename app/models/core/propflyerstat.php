<?php

namespace App\models\core;

class propflyerstat extends \App\Model
{
   protected $primaryKey = 'propflyer_id';

   protected $dates = [
      'created_at','updated_at','xLastDeliveryDate'
   ];

	public function theAgent(){
		return $this->belongsTo('App\models\core\propagent','propagent_id','id');
	}

	public function theOffice(){
	  return $this
	  ->belongsTo('App\models\core\agtoffice','propagent_id','propagent_id');
	}

   public function theAgentMeta(){
		return $this
		->hasOne('App\models\core\propagentmeta','propagent_id','propagent_id');
	}

   public function theAgentCleanup(){
		return $this
		->hasOne('App\models\core\propagentcleanup','propagent_id','propagent_id');
	}
}
