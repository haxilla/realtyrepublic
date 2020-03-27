<?php

namespace App\models\autosynch\propremark;

class propremarkOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyers';
	protected $primaryKey = 'ufid';
	/*
	protected $table='propremarks';
	protected $primaryKey = 'propflyer_id';
	*/
}