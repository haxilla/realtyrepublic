<?php

namespace App\autosynch\models\propflyer;

class propflyerOldArc2 extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyerarch2';
	protected $primaryKey = 'ufid';
	public $timestamps = false;

}