<?php

namespace App\autosynch\models\propdeliv;

class propdelivOldArc extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remaildeliveriesmaster';
	protected $primaryKey = 'campaignID';

}