<?php

namespace App\bounces\models;

class bounceWorksheet extends \App\Model
{
	protected $table="rememaildb.bounceWorksheet";
	protected $primaryKey='bounceID';
	protected $dates=['created_at','updated_at'];
}
