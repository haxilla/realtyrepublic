<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Offices_history extends \App\Model
{

	protected $table = 'rets.GLVAR_Offices_history';
	protected $primaryKey='historyID';
	protected $dates=['created_at','updated_at'];

}
