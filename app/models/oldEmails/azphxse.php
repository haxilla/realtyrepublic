<?php

namespace App\models\oldEmails;

class azphxse extends \App\Model
{

	public $timestamps = false;

	protected $table = 'azphxse';
	protected $dates = ['entryDate','xLastHit'];
	protected $connection = 'oldEmails';

}
