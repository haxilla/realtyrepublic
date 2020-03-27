<?php

namespace App\models\oldEmails;

class azsaz extends \App\Model
{
	public $timestamps = false;

	protected $table = 'esouthernazcounties';
	protected $dates = ['entryDate','xLastHit'];
	protected $connection = 'oldEmails';
	
}
