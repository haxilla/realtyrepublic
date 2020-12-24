<?php

namespace App\autosynch\models\propdelivnow;

class propdelivnowOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remaildeliveriesnow';
	protected $primaryKey = 'campaignid';

}