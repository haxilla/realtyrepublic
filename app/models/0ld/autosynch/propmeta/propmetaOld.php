<?php

namespace App\models\autosynch\propmeta;

class propmetaOld extends \App\Model
{


	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';
	/*
	protected $table='propmetas';
	protected $primaryKey = 'propflyer_id';
	*/
}