<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class adminAutoSuggestController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function search(){
		//set variables
		$searchTerm=request('searchTerm');
		$category=request('category');
		//error if none
		if(!$searchTerm||!$category){
			dd("error-line21-adminAutoSuggestController");}

		if($category=='all'||$category=='adreAgent'){
			include(app_path().'/admin/autosearch/queries/adreAgent.php');
		}
		if($category=='all'||$category='members'){
			include(app_path().'/admin/autosearch/queries/propagent.php');
		}		
		if($category=='all'||$category=='flyers'){
			//PROPFLYERS
		}
		if($category=='all'||$category=='glvarAgents'){
			include(app_path().'/admin/autosearch/queries/glvarAgent.php');
		}

		$html=\View::make('admin.autoSuggestions.results')
		->with([
			'adreAgents'=>$adreAgents,
			'glvarAgents'=>$glvarAgents,
			'propagents'=>$propagents,
		])->render();

		if($adreAgents->count()>0
		||$glvarAgents->count()>0
		||$propagents->count()>0){
			echo $html;
		}

		exit();

	}

}
