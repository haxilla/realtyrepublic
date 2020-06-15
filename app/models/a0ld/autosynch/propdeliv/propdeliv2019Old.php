<?php

namespace App\models\autosynch\propdeliv;

class propdeliv2019Old extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='remaildeliveries2019';
	protected $primaryKey = 'campaignID';

}