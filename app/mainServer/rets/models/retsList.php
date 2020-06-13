<?php

namespace App\rets\models;

class retsList extends \App\Model
{

	protected $table = 'rets.retsList';
	protected $primaryKey='retsID';
	protected $dates=['lastSynchDate','created_at','updated_at'];

}
