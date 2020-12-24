<?php

namespace App\autosynch\models\propflyerstat;

class propflyerstatOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';
	/*
	protected $table='propflyerstats';
	protected $primaryKey = 'propflyer_id';
	*/
}