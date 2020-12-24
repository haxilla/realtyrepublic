<?php

namespace App\rets\matrix\GLVAR\synch\models;

class Offices_synch extends \App\Model
{

	protected $table = 'rets.GLVAR_Offices_synch';
	protected $primaryKey='Matrix_Unique_ID';
	protected $dates=['created_at','updated_at'];

}