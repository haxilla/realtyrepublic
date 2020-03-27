<?php

namespace App\models\oldEmails;

class aznaz extends \App\Model
{
	public $timestamps = false;

	protected $dates = ['entryDate','xLastHit'];
	protected $table = 'enorthernazcounties';
	protected $connection = 'oldEmails';

}
