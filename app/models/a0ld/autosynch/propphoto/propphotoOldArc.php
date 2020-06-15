<?php

namespace App\models\autosynch\propphoto;

class propphotoOldArc extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remailphotosmaster';
	protected $primaryKey = 'photoID';

}