<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Homes_history extends \App\Model
{

	protected $table = 'rets.GLVAR_Homes_history';
	protected $primaryKey='historyID';
	protected $dates=['created_at','updated_at'];

}
