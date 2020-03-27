<?php

namespace App\models\oldEmails;

class azphxmetro extends \App\Model
{
	
	public $timestamps = false;

	protected $dates = ['entryDate','xLastHit'];
	protected $table = 'azphxmetro';      
	protected $connection = 'oldEmails';

}
