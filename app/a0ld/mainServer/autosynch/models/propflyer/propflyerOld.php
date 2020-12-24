<?php

namespace App\autosynch\models\propflyer;

class propflyerOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';
	public $timestamps = false;

}