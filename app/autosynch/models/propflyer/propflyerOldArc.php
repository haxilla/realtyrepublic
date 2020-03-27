<?php

namespace App\autosynch\models\propflyer;

class propflyerOldArc extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyersmaster';
	protected $primaryKey = 'ufid';
	public $timestamps = false;

}