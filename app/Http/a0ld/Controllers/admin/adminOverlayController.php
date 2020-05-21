<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class adminOverlayController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index(){

		$menuClass=request('menuClass');

		if(!$menuClass){
			dd('error-line21-adminOverlayController');}

		include(app_path()."/overlays/$menuClass/variables/render.php");

	}
}
