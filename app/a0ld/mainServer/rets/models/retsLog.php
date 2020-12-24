<?php

namespace App\rets\models;

class retsLog extends \App\Model
{

	protected $table = 'rets.retsLog';
	protected $primaryKey='logID';
	protected $dates=['created_at','updated_at'];

}
