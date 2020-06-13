<?php 

namespace App\autosynch\models\downloads;

class agentlogoDownload extends \App\Model
{
	protected $connection = 'oldsite';
	protected $table 	  = 'emailagents';

	public static function downloadCount(){

		return 	$theCount=static::whereNull('agtLogoCheck')
				->select('logo','officeID','umid')
				->whereNotNull('logo')
				->where('logo','!=','logosample.gif')
				->orWhere(function($q){
				   $q->whereRaw('last_login > agtLogoCheck')
				   ->whereNotNull('logo')
				   ->where('logo','!=','logosample.gif');
				})->count();
	}

}