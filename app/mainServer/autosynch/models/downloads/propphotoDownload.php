<?php

namespace App\autosynch\models\downloads;

class propphotoDownload extends \App\Model
{

	protected $table = 'propphotos';

	public static function downloadCount(){

		return $theCount=static::select('photoID')
			->where('photoDate','>','2017-01-01')
			->whereNull('existCheck')
			->count();

	}

}