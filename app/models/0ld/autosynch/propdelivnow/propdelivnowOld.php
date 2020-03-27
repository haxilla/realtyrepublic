<?php

namespace App\models\autosynch\propdelivnow;

class propdelivnowOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remaildeliveriesnow';
	protected $primaryKey = 'campaignid';

}