<?php

namespace App\Http\Controllers\cron;
use App\Http\Controllers\Controller;

use Request;

class cronController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function cronStart(){
		include(app_path().'/rets/cronStart.php');
	} 

}
