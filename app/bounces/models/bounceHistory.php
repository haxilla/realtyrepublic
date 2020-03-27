<?php

namespace App\bounces\models;

class bounceHistory extends \App\Model
{
	protected $table="rememaildb.bounceHistory";
	protected $primaryKey='historyID';
	protected $dates=['created_at','updated_at'];
}
