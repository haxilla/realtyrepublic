<?php

namespace App\autosynch\models\propdeliv;

class propdelivOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remaildeliveries2019';
	protected $primaryKey = 'campaignID';

}