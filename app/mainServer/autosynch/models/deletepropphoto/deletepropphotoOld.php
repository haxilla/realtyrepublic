<?php

namespace App\autosynch\models\deletepropphoto;

class deletepropphotoOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table ='remailphotodeletes';
	protected $primaryKey='locname';
	public $timestamps=false;


}