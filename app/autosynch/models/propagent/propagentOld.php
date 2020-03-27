<?php

namespace App\autosynch\models\propagent;

class propagentOld extends \App\Model
{

	protected $connection 	= 'oldsite';
	protected $table 		= 'emailagents';
	protected $primaryKey 	= 'umid';
	public 	  $timestamps 	= false;

}