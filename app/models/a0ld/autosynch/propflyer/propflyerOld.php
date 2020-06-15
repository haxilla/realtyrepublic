<?php

namespace App\models\autosynch\propflyer;

class propflyerOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';

}