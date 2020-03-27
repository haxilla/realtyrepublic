<?php

namespace App\models\oldEmails;

class azphxne extends \App\Model
{

	public $timestamps = false;

	protected $table = 'azphxne';
	protected $connection = 'oldEmails';
	protected $dates = ['entryDate','xLastHit'];

}
