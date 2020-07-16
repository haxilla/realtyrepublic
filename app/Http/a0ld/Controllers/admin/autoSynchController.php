<?php

namespace App\Http\a0ld\Controllers\admin;
use App\Http\a0ld\Controllers\Controller;

use Illuminate\Http\Request;

class autoSynchController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function synchStart(){
		include(app_path().'/autosynch/synchStart.php');
	}

	public function synchProgress(){
		include(app_path().'/autosynch/synchProgress.php');
	}

	public function synchDownloads(){
		include(app_path().'/autosynch/synchDownloads.php');
	}

	public function agtPswdFix(){
		include(app_path().'/admin/memberfix/agtPswdFix.php');
	}

}
