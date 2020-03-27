<?php

namespace App\rets\matrix\GLVAR\synch\models;

class Agents extends \App\Model
{

	protected $table = 'rets.GLVAR_Agents';
	protected $primaryKey='Matrix_Unique_ID';
	protected $dates=['created_at','updated_at'];

}
