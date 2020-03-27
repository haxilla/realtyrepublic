<?php

namespace App\Http\Controllers\rets;
use App\Http\Controllers\Controller;

class retsSynchController extends Controller
{

	public function __construct()
	{
	  $this->middleware('auth:admin');
	}	

	public function retsCompare(){
		//gets variable from retsID
		include(app_path().'/rets/retsIDcheck.php');
		//compares all classes & logs
		include(app_path()."/rets/$retsSystem/$mlsName/compare/compare_index.php");
	}

	public function retsSynch(){

		//gets variable from retsID
		include(app_path().'/rets/retsIDcheck.php');

		//gets files and inserts new
		include(app_path()."/rets/$retsSystem/$mlsName/synch/synch_index.php");
	}

	public function retsProgress(){
		// * gets variable from retsID * //
		include(app_path().'/rets/retsIDcheck.php');

		// * synch * //
		if($monitor=='synch'){
			include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/monitor.php");
		
		// * compare * //
		}elseif($monitor=='compare'){
			include(app_path()."/rets/$retsSystem/$mlsName/compare/progress/monitor.php");

		// * error * //
		}else{
			dd('error-line45-retsSynchController');}
	
	}

	public function retsOverlay(){
		// * gets variable from retsID * //
		include(app_path().'/rets/retsIDcheck.php');
		// render variables into view
		include(app_path().'/rets/render/synchData.php');

	}


}