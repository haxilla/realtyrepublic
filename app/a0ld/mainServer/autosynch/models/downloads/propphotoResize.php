<?php

namespace App\autosynch\models\downloads;

class propphotoResize extends \App\Model
{

	protected $table = 'propphotos';

	public static function downloadCount(){

		//resize count
		return $theCount=static::select('photoID')
		->where('photoDate','>','2017-01-01')
		->where('resized','=',0)
		->count();

	}

	public function theMeta(){

		return $this
		->hasOne('App\autosynch\models\propmeta\propmetas',
		'propflyer_id','propflyer_id');

	}



}