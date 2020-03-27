<?php

namespace App\models\autosynch\propstyle;

class propstyleOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailstyles';
	protected $primaryKey = 'ufid';

}