<?php

namespace App\rets\matrix\GLVAR\synch\models;

class Homes_synch extends \App\Model
{

	protected $table = 'rets.GLVAR_Homes_synch';
	protected $primaryKey='Matrix_Unique_ID';
	protected $dates=['created_at','updated_at'];

}
