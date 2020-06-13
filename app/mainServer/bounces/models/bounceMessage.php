<?php

namespace App\bounces\models;

class bounceMessage extends \App\Model
{
	protected $table="rememaildb.bounceMessage";
	protected $primaryKey='msgID';
	protected $dates=['created_at','updated_at'];
}
