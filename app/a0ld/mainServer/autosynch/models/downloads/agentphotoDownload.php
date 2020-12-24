<?php

namespace App\autosynch\models\downloads;

class agentphotoDownload extends \App\Model
{
	protected $connection = 'oldsite';
	protected $table 	  = 'emailagents';

   	public static function downloadCount(){

		return 	$theCount=static::select('agentPhoto','umid','officeID')
				->whereNull('agtPhotoCheck')
				->whereNotNull('agentPhoto')
				->where('agentPhoto','!=','agentSample.gif')
				->orWhere(function($q){
				   $q->whereRaw('last_login > agtPhotoCheck')
				   ->whereNotNull('agentPhoto')
				   ->where('agentPhoto','!=','agentSample.gif');
				})->count();

	}



}