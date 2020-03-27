<?php

namespace App\Http\Controllers\adre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class adreController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index(){

		return view('adre.adreIndex',[]);

	}

	public function fileUpload(){

		include(app_path().'/adre/uploads/newFileUpload.php');

	}

	public function puppeteer(){

		include(app_path().'/adre/puppeteer/index.php');

	}
}
