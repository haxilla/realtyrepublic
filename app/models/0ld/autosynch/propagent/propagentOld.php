<?php

namespace App\models\autosynch\propagent;

class propagentOld extends \App\Model
{

	protected $connection = 'oldsite';
	protected $table='emailagents';
	protected $primaryKey = 'umid';

}