<?php

namespace App\autosynch\models\propmapping;

class propmappingOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';
	/*
	protected $table='propmappings';
	protected $primaryKey = 'propflyer_id';
	*/
}