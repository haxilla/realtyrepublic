<?php

namespace App\Http\Controllers\thePublic;
use App\Http\Controllers\Controller;
use Request;


class publicSearchController extends Controller
{

  public function searchResults(){

    //include query
    include(app_path().'/queries/publicSearch.php');

    //render view
    $html=\View::make('mdbxPublic.render.publicSearch.searchResults')
		->with([
			'searchResults'=>$searchResults,
		])->render();

    //display
    echo $html;

  }


}
