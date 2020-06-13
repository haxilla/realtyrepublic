<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Homes_changelog extends \App\Model
{

	protected $table = 'rets.GLVAR_Homes_changelog';
	protected $primaryKey='changeID';
	protected $dates=['created_at','updated_at'];

}
