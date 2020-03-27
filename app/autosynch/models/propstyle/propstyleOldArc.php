<?php

namespace App\autosynch\models\propstyle;

class propstyleOldArc extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailstyles_arch';
	protected $primaryKey = 'ufid';

}