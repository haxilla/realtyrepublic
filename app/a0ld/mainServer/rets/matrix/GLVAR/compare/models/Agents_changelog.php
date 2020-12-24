<?php

namespace App\rets\matrix\GLVAR\compare\models;

class Agents_changelog extends \App\Model
{

	protected $table = 'rets.GLVAR_Agents_changelog';
	protected $primaryKey='changeID';
	protected $dates=['created_at','updated_at'];

}
