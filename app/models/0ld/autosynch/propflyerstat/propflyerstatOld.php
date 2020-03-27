<?php

namespace App\models\autosynch\propflyerstat;

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