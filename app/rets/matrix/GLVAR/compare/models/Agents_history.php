<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Agents_history extends \App\Model
{

	protected $table = 'rets.GLVAR_Agents_history';
	protected $primaryKey='historyID';
	protected $dates=['created_at','updated_at'];

}
