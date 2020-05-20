<?php

namespace App\devJournal\models;

class devtaskstep extends \App\Model
{
	protected $table = 'remdev.devtasksteps';
	protected $primaryKey='stepID';

	public function theTask(){
	  return $this->belongsTo('App\devJournal\models\devtask','taskID','taskID');
	}
}
