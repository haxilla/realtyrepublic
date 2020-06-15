<?php

namespace App\models\autosynch\propphoto;

class propphotoOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailphotos';
	protected $primaryKey = 'photoID';

}