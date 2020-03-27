<?php

namespace App\models\autosynch\propflyer;

class propflyerOldArc extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailflyersmaster';
	protected $primaryKey = 'ufid';

}