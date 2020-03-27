<?php

namespace App\devJournal\models;

class devtip extends \App\Model
{
	protected $table = 'remdev.devtips';
	protected $primaryKey='tipID';
	protected $dates=['lastComment'];

	public function taskComments(){
	  return $this->hasMany('App\devJournal\models\devtaskcomment','taskID','taskID')
	  ->orderBy('created_at','desc');
	}

	public function adminInfo(){
	  return $this->hasOne('App\models\admin\adminTable','id','adminID');
	}

	public function taskDetails(){
		return $this->hasMany('App\devJournal\models\devtaskdetail','taskID','taskID');
	}

	public function taskSteps(){
	  return $this->hasMany('App\devJournal\models\devtaskstep','taskID','taskID');
	}
}