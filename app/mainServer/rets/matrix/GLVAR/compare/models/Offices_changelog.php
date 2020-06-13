<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Offices_changelog extends \App\Model
{

	protected $table = 'rets.GLVAR_Offices_changelog';
	protected $primaryKey='changeID';
	protected $dates=['created_at','updated_at'];

}
