<?php

namespace App\models\admin;

class adminTable extends \App\Model
{

	protected $table = 'remdev.dadmins';
	protected $guard = 'admin';

	public static function adminInfo(){
		//set adminID
		$adminID=\Auth::guard('admin')->user()->id;
		//adminInfo
		$adminInfo=static::where('id','=', $adminID)
		->first();
		//send
		return $adminInfo;
	}
}
